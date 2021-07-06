<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserSelectBoxCollection;
use App\Imports\User\FirstSheetImport;
use App\Imports\User\UsersImport;
use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
  protected $user;

  public function __construct(User $user)
  {
    $this->user = $user;
  }

  /**
   * Display a listing of the resource.
   *
   * @param str $search
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $user = $this->user
      ->select('id', 'name', 'kana_name', 'username', 'email', 'phone', 'birthday', 'job_title', 'avatar', 'active', 'department_id')
      ->with('roles:id,name')
      ->search($request->search)
      ->ordered()
      ->paginated($request->length);
    return new UserCollection($user);
  }

  /**
   * Hiển thị các thành viên của phòng ban
   * @param object $request
   * @param int $departmentId
   * @return json
   */
  public function getUsersByDepartmentId(Request $request, $departmentId)
  {
    $user = $this->user
      ->select('id', 'name', 'kana_name', 'username', 'email', 'phone', 'birthday', 'job_title', 'avatar', 'active', 'department_id')
      ->where('department_id', $departmentId)
      ->with('roles:id,name')
      ->search($request->search)
      ->ordered()
      ->paginated($request->length);
    return new UserCollection($user);
  }

  /**
   * Get id, name, avatar, username attribute from users for select box
   */
  public function getUsersForSelectBox(Request $request)
  {
    $users = $this->user
      ->select('id', 'name', 'kana_name', 'username', 'avatar')
      ->where('active', 1)
      ->search($request->search)
      ->ordered()
      ->paginated($request->length);
    return new UserSelectBoxCollection($users);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(UserRequest $request)
  {
    DB::beginTransaction();
    try {
      $password = Str::random(8);
      $data     = array_merge($request->all(), ['password' => bcrypt($password)]);
      $user     = $this->user->create($data);
      $user->assignRole($request->role);

      dispatch(new SendEmail(array_merge($user->toArray(), ['password' => $password])));

      DB::commit();
      return response()->json([
        'message' => 'New user created successfully',
        'data'    => new UserResource($user),
      ], 201);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['message' => $th->getMessage()], 400);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $user = $this->user->findOrFail($id)->load('department:id,name');
    return new UserResource($user);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    DB::beginTransaction();
    try {
      $validator   = Validator::make($request->all(), (new UserRequest)->rules($id));
      if ($validator->fails()) return response()->json($validator->errors(), 422);

      $user = User::findOrFail($id);

      if ($user->avatar && $request->avatar) {
        File::delete('storage/images/avatars/' . $user->avatar);
      }
      $data = $request->except(['avatar', '_method']);

      if ($request->role) {
        $user->syncRoles($request->role);
      }

      if ($request->avatar) {
        $avatar = $request->file('avatar');
        $filename = $user->username . '_' . uniqid() .  '.' .  $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(300, 300)->save(public_path('storage/images/avatars/' . $filename));
        $data['avatar'] = $filename;
      }

      $user->update($data);
      DB::commit();
      return response()->json([
        'status' => 'Updated successfully!',
        'user' => new UserResource($user)
      ], 200);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['message' => $th->getMessage()], 400);
    }
  }

  /**
   * Soft delete the specified resource from storage.
   *
   * @param  array  $ids
   * @return \Illuminate\Http\Response
   */
  public function softDelete(Request $request)
  {
    $users = $this->user->whereIn('id', $request->ids)->get();

    foreach ($users as $user) {
      if ($user->hasRole('admin')) {
        return response()->json(['message' => 'Not allowed to delete admin.'], 405);
      }
    }

    $this->user->destroy($request->ids);

    return response()->json([
      'message' => 'Deleted successfully',
    ]);
  }

  /**
   * Display a listing trashed of the resource.
   *
   * @param str $search
   * @return \Illuminate\Http\Response
   */
  public function trashed(Request $request)
  {
    $users = $this->user->onlyTrashed()->search($request->search)->ordered()->paginated();
    return UserResource::collection($users);
  }

  /**
   * Restore the specified resource.
   *
   * @param  array  $ids
   * @return \Illuminate\Http\Response
   */
  public function restore(Request $request)
  {
    $result  = $this->user->onlyTrashed()->whereIn('id', $request->ids)->restore();
    $message = 'No users were restore.';

    if ($result === 1) $message = 'User successfully restored.';
    if ($result > 1)  $message = 'Users successfully restored.';

    return response()->json([
      'message' => $message,
      'restored' => $result,
    ]);
  }

  /**
   * Hard delete the specified resource from storage.
   *
   * @param  array  $ids
   * @return \Illuminate\Http\Response
   */
  public function forceDelete(Request $request)
  {
    $users  = $this->user->onlyTrashed()->find($request->ids);

    $index = 0;
    foreach ($users as $user) {
      $user->forceDelete();
      $index++;
    }

    $message = 'No users were deleted.';

    if ($index === 1) $message = 'User successfully deleted.';
    if ($index > 1)  $message = 'Users successfully deleted.';

    return response()->json([
      'message' => $message,
      'deleted' => $index,
    ]);
  }

  public function import(Request $request)
  {
    $rows = Excel::toCollection(new UsersImport, $request->file('import_file'))->first();
    $firstSheetImport = new FirstSheetImport;
    $import = $firstSheetImport->collection($rows);

    if ($import['status'] === 'error') {
      return response()->json($import['errors'], 422);
    } else {
      return UserResource::collection($import['result']);
    }
  }

  public function downloadExcelTemplate()
  {
    return response()->download(public_path('templates/excel/import_users.xlsx'));
  }
}
