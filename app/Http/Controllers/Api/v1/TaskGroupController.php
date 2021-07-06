<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaskGroup;
use App\Http\Requests\TaskGroupsRequest;


class TaskGroupController extends Controller
{
  protected $taskGroup;

  public function __construct(TaskGroup $taskGroup)
  {
    $this->taskGroup = $taskGroup;
  }

  /**
   * Get all task groups and related task types
   */
  public function index()
  {
    $taskGroups = $this->taskGroup->with('taskTypes')->get();
    return $taskGroups;
  }

  public function getTaskGroupForSelectBox()
  {
    $taskGroups = $this->taskGroup->select('id', 'name')->get();
    return $taskGroups;
  }

  public function store(TaskGroupsRequest $request)
  {
    $newTaskGroups = $this->taskGroups->create($request->all());
    return response()->json([
      'message' => 'Created successfully!',
      'data' => $newTaskGroups
    ], 201);
  }

  public function update(TaskGroupsRequest $request, $id)
  {
    $taskGroups = $this->taskGroups->find($id);
    $taskGroups->update($request->all());

    return response()->json([
      'message' => 'success',
      'data' => $taskGroups
    ]);
  }

  public function destroy(Request $request, $id)
  {
    $taskGroups = TaskGroup::findOrFail($id);
    $taskGroups->delete();

    return response()->json([
      'status' => 'success',
    ]);
  }
}
