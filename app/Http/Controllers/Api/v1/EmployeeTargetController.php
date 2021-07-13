<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\EmployeeTarget;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeTargetRequest;
use App\Models\Department;
use App\Models\DepartmentTarget;
use Illuminate\Support\Facades\DB;

class EmployeeTargetController extends Controller
{
  protected $employeeTarget;
  protected $department;
  protected $departmentTarget;
  public function __construct(EmployeeTarget $employeeTarget, Department $department, DepartmentTarget $DepartmentTarget)
  {
    $this->employeeTarget = $employeeTarget;
    $this->department = $department;
    $this->DepartmentTarget = $DepartmentTarget;
  }

  /**
   * get all employee targets
   *  @param object $request
   * @return json
   */
  public function index()
  {
    $employeeTargets = $this->employeeTarget->all();
    return $employeeTargets;
  }


  /**
   * get all employee targets of all users in the department by month year
   * @param object $request
   * @return json
   */
  public function getAllEmployeeTargetByDepartmentId(Request $request, $department_id)
  {
    $sum = 0;
    $employeeTargets = $this->department->find($department_id)->user;
    $listEmployeeMonth = [];
    $monthYear = $request->year . '-' . $request->month;
    foreach ($employeeTargets as $item) {

      $employeeTarget = $item->employeeTarget()
        ->where('from', 'like', '%' . $monthYear . '%')->get();
      array_push($listEmployeeMonth, $employeeTarget);
  // sum all targets employee of user in department by month year
      $sum += $employeeTarget->sum('targets');
    }
    
  //get department_targets by month year
    $targets = 0;
    $departmentTarget = $this->DepartmentTarget
      ->where('from', 'like', '%' . $monthYear . '%')
      ->where('department_id', $department_id)
      ->get('targets');
    $targets += $departmentTarget->sum('targets');
    if(round($sum) > round($targets)){
      $message = "Total employee targets exceeds departmental targets!";
    }else if(round($sum) < round($targets)){
      $message = "The total target of employees has not met the department's target!";
    }else
      $message = '';

    return response()->json([
      'message' => $message,
      'data' => $listEmployeeMonth
    ]);

    return $listEmployeeMonth;
  }

  /**
   * update targets of users by month
   * @param object $request
   * @return json
   */
  public function update(EmployeeTargetRequest $request, $id)
  {
    $listTargets = [];
    $Target = $this->employeeTarget->find($id);
    $Target->update($request->all());
    array_push($listTargets, $Target);


    $department = $this->employeeTarget->find($id)->User()->get();
  //get data month Year by from table employee_targets
    $monthYear = substr($Target->from, 0, 7);
  //get department_id by table department_targets
    $sum = 0;
    foreach($department as $val){
      $department_id = $val->department_id;
    }
  //caculator sum targets employee of department
    $employeeTargets = $this->department->find($department_id)->user;
    foreach ($employeeTargets as $item){
      $employeeTarget = $item->employeeTarget()
        ->where('from', 'like', '%' . $monthYear . '%')->get();
      $sum += $employeeTarget->sum('targets');
    }
  //get department_targets by month year
    $targets = 0;
    $departmentTarget = $this->DepartmentTarget
      ->where('from', 'like', '%' . $monthYear . '%')
      ->where('department_id', $department_id)
      ->get('targets');
    $targets += $departmentTarget->sum('targets');
    if(round($sum) > round($targets)){
      $message = "Total employee targets exceeds departmental targets!";
    }else if(round($sum) < round($targets)){
      $message = "The total target of employees has not met the department's target!";
    }else
      $message = '';
    return response()->json([
      'message' => 'Updated successfully!',
      'data' => $listTargets,
      'message_compare_money' => $message,
    ], 200);
  }
  /**
   * delete targets of user
   * @param object $request
   * @return json
   */
  public function softDelete($id)
  {
    $employeeTarget = $this->employeeTarget->find($id);
    $employeeTarget->delete();
    return response()->json([
      'message' => 'Deleted successfully!'
    ]);
  }
}
