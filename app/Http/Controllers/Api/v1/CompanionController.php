<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Companion;
use App\Http\Requests\CompanionRequest;
use App\Http\Resources\Companion\CompanionsCollection;
use App\Http\Resources\Companion\CompanionsSelectBoxCollection;
use Image;
use Illuminate\Support\Facades\File;

class CompanionController extends Controller
{
  protected $companion;

  public function __construct(Companion $companion)
  {
    $this->companion = $companion;
  }

  /**
   * Get all companions
   */
  public function index(Request $request)
  {
    $companions = $this->companion->search($request->search)->ordered()->paginated($request->length);
    return new CompanionsCollection($companions);
  }

  /**
   * Get companion for select box
   * @param object $request
   * @return json
   */

  public function getCompanionsForSelectBox(Request $request)
  {
    $companions = $this->companion
      ->select('id', 'name')
      ->search($request->search)
      ->ordered()
      ->paginated($request->length);

    return new CompanionsSelectBoxCollection($companions);
  }

  public function store(CompanionRequest $request)
  {
    $data = $request->except(['avatar', '_method']);
    if ($request->hasFile('avatar')) {

      $filename = uniqid() . '.' . $request->file('avatar')->getClientOriginalExtension();
      $avatar = $request->file('avatar');
      Image::make($avatar)->resize(300, 300)->save(public_path('storage/images/companions/' . $filename));
      $data['avatar'] = $filename;
    }
    $newCompanion = $this->companion->create($data);
    return response()->json([
      'message' => 'Created successfully!',
      'data' => $newCompanion
    ], 201);
  }


  public function update(CompanionRequest $request, $id)
  {
    $companion = $this->companion->find($id);

    if ($companion->avatar) {
      File::delete('storage/images/companions/' . $companion->avatar);
    }

    $data = $request->except(['avatar', '_method']);

    if ($request->hasFile('avatar')) {
      $avatar = $request->file('avatar');
      $filename = uniqid() . '.' . $request->file('avatar')->getClientOriginalExtension();
      Image::make($avatar)->resize(300, 300)->save(public_path('storage/images/companions/' . $filename));
      $data['avatar'] = $filename;
    }

    $companion->update($data);

    return response()->json([
      'message' => 'Updated successfully!',
      'data' => $companion
    ]);
  }

  public function softDelete(Request $request)
  {
    $this->companion->destroy($request->ids);

    return response()->json([
      'message' => 'Deleted successfully!',
    ]);
  }
}
