<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaskType;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TaskTypesRequest;
use App\Http\Resources\TaskType\TaskTypeCollection;
use App\Http\Resources\TaskType\TaskTypesSelectBoxCollection;
use App\Models\TaskGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class TaskTypeController extends Controller
{
  protected $taskTypes;

  public function __construct(TaskType $taskTypes)
  {
    $this->taskTypes = $taskTypes;
  }

  public function index()
  {
    $taskGroups = TaskGroup::with('taskTypes')->get();
    return new TaskTypeCollection($taskGroups);
  }

  /**
   * Get task types for select box
   */
  public function getTaskTypesForSelectBox()
  {
    $taskTypes = TaskGroup::select('id', 'name')->with('taskTypes:id,task_group_id,name')->get();
    return new TaskTypesSelectBoxCollection($taskTypes);
  }

  public function store(TaskTypesRequest $request)
  {
    $newTaskTypes = $this->taskTypes->create($request->all());

    return response()->json([
      'message' => 'Created successfully!',
      'data' => $newTaskTypes
    ], 201);
  }

  public function update(TaskTypesRequest $request, $id)
  {
    $taskTypes = $this->taskTypes->find($id);
    $taskTypes->update($request->all());

    return response()->json([
      'message' => 'Created successfully!',
      'data' => $taskTypes
    ]);
  }

  public function destroy($id)
  {
    $taskTypes = TaskType::findOrFail($id);
    $taskTypes->delete();

    return response()->json([
      'status' => 'Deleted successfully!',
    ]);
  }
}
