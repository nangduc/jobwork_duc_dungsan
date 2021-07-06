<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\Department\DepartmentCollection;
use App\Http\Resources\Department\DepartmentResource;
use App\Http\Resources\Department\DepartmentSelectBoxCollection;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
  protected $department;

  public function __construct(Department $department)
  {
    $this->department = $department;
  }

  /**
   * Get all   
   */
  public function index(Request $request)
  {
    $departments = $this->department
      ->where('parent_id', null)
      ->with(['manager:id,name,kana_name,username,avatar'])
      ->search($request->search)
      ->ordered()
      ->paginated($request->length);
    return DepartmentResource::collection($departments);
  }

  /**
   * Get id, name attribute from departments for select box
   */
  public function getDepartmentsForSelectBox()
  {
    $departments = $this->department->select('id', 'name', 'parent_id', '_lft', '_rgt')->get()->toTree();
    
    return new DepartmentSelectBoxCollection($departments);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(DepartmentRequest $request)
  {
    $this->department->create($request->all());
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
