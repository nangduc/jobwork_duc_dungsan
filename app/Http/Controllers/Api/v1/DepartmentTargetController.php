<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\DepartmentTarget;
use Illuminate\Http\Request;
use App\Http\Resources\DepartmentTarget\DepartmentTargetCollection;
use App\Http\Requests\DepartmentTargetRequest;
use App\Models\Department;
use App\Models\EmployeeTarget;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DepartmentTargetController extends Controller
{
  protected $departmentTarget;
  protected $department;
  protected $employeeTarget;

  public function __construct(DepartmentTarget $departmentTarget,Department $department,EmployeeTarget $employeeTarget)
  {
    $this->departmentTarget = $departmentTarget;
    $this->department = $department;
    // $this->employeeTarget = $employeeTarget;
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
    ->where('from', 'like', '%' .$request->year . '%')
    ->where('department_id',$id)
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
    // $dateString = '2021-5-1';
    // $lastDateOfMonth = date("Y-m-t", strtotime($dateString));
    // dd($lastDateOfMonth);


    $department = $this->department->find($request->department_id)->employee;
    foreach ($department as $item)

      echo $item->username;
      echo '1';
    dd(1);
   

    foreach (range(1, 12) as $month) {
      $dateFirst_month = $request->year.'-'.$month.'-01';
      $dateLast_month = date("Y-m-t", strtotime($dateFirst_month));


      $department_target = $this->departmentTarget->create([
            'department_id' => $request->department_id,
            'targets' => $request->targets/12,
            'from' => $dateFirst_month,
            'to' => $dateLast_month,
        ]);
      
      

      
      

    }
    return response()->json([
      'message' => 'Created successfully!',
    ], 201);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(DepartmentRequest $request, $id)
  {
    $department = $this->department->find($id);
    $department->update($request->all());
    return response()->json([
      'message' => 'Updated successfully!',
    ]);
  }

  /**
   * Soft delete the specified resource from storage.
   *
   * @param  array  $ids
   * @return \Illuminate\Http\Response
   */
  public function softDelete($id)
  {
    $department = $this->department->find($id);
    $department->delete();
    return response()->json([
      'message' => 'Deleted successfully!',
    ]);
  }
}
