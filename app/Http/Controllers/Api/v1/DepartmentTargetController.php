<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Models\DepartmentTarget;
use Illuminate\Http\Request;
use App\Http\Resources\DepartmentTarget\DepartmentTargetCollection;
use App\Http\Requests\DepartmentTargetRequest;
use App\Http\Requests\DepartmentTargetUpdateRequest;
use App\Models\Department;
use App\Models\EmployeeTarget;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DepartmentTargetController extends Controller
{
  protected $departmentTarget;
  protected $department;
  protected $employeeTarget;

  public function __construct(DepartmentTarget $departmentTarget, Department $department, EmployeeTarget $employeeTarget)
  {
    $this->departmentTarget = $departmentTarget;
    $this->department = $department;
    $this->employeeTarget = $employeeTarget;
  }

  /**
   * get all departmentTargets
   * @param object $request
   * @return json
   */
  public function index(Request $request)
  {

    $departmentTargets = $this->departmentTarget->all();
    return $departmentTargets;
  }
  /**
   * Get targets and achievements departments
   * @param object $request
   * @return json
   */
  public function getDepartmentTargetByDepartmentId(Request $request, $id)
  {
    $departmentTargets = $this->departmentTarget
      ->where('from', 'like', '%' . $request->year . '%')
      ->where('department_id', $id)
      ->get();
    return $departmentTargets;
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(DepartmentTargetRequest $request)
  {
    // $listemployee_month = [];

    // $department = $this->department->find($request->department_id)->employee;
    // foreach ($department as $item) {
    //     $abc = $item->employee_target()->where('from', 'like', '%' . '2021-02' . '%')->get();
    //     array_push($listemployee_month,$abc);
    // }
    // return $listemployee_month;



    try {
      DB::beginTransaction();
      foreach (range(1, 12) as $month) {
        $dateFirst_month = $request->year . '-' . $month . '-01';
        $dateLast_month = date("Y-m-t", strtotime($dateFirst_month));


        $department_target = $this->departmentTarget->create([
          'department_id' => $request->department_id,
          'targets' => $request->targets / 12,
          'achievement' => '0',
          'from' => $dateFirst_month,
          'to' => $dateLast_month,
        ]);

        $department = $this->department->find($request->department_id)->employee;
        foreach ($department as $item) {
          $employee_target = $this->employeeTarget->create([
            'user_id' => $item->id,
            'targets' => $request->targets / 12 / count($department),
            'achievement' => '0',
            'from' => $dateFirst_month,
            'to' => $dateLast_month
          ]);
        }
      }

      DB::commit();
      return response()->json([
        'message' => 'Created successfully!',
      ], 201);
    } catch (\Exception $exception) {
      DB::rollBack();
      Log::error('message:' . $exception->getMessage() . 'Line :' . $exception->getLine());
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(DepartmentTargetUpdateRequest $request, $id)
  {
    try {
      DB::beginTransaction();
      $department_target = $this->departmentTarget
        ->where('department_id', $id)
        ->where('from', 'like', '%' . $request->year . '-' . $request->month . '%')->first();

      $department_target->update([
        'targets' => $request->targets,
      ]);


      DB::commit();
      return response()->json([
        'message' => 'Updated successfully!',
      ]);
    } catch (\Exception $exception) {
      DB::rollBack();
      Log::error('message:' . $exception->getMessage() . 'Line :' . $exception->getLine());
    }
  }

  /**
   * Soft delete the specified resource from storage.
   *
   * @param  array  $ids
   * @return \Illuminate\Http\Response
   */
  public function softDelete($id) # xoa tat ca muc tieu cua 1 phong ban
  {
    try {
      DB::beginTransaction();
      $department_target = $this->departmentTarget
        ->where('department_id', $id);

      $department_target->delete();

      $department = $this->department->find($id)->employee;
      foreach ($department as $item) {
        $abc = $item->employee_target()->delete();
      }


      DB::commit();
      return response()->json([
        'message' => 'Deleted successfully!',
      ]);
    } catch (\Exception $exception) {
      DB::rollBack();
      Log::error('message:' . $exception->getMessage() . 'Line :' . $exception->getLine());
    }
  }
}
