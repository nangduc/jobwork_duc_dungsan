<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskProgressRequest;
use App\Http\Resources\TaskProgress\TaskProgressResource;
use App\Models\TaskProgress;
use Illuminate\Http\Request;

class TaskProgressController extends Controller
{
  protected $taskProgress;

  public function __construct(TaskProgress $taskProgress)
  {
    $this->taskProgress = $taskProgress;
  }

  /**
   * Get task progresses by task_id
   * @param int $taskId
   * @return json
   */
  public function getTaskProgressByTaskId(Request $request, $taskId)
  {
    $taskProgresses = $this->taskProgress
      ->with([
        'saleStatus:id,name,color',
        'negotiationStatus:id,name,color',
        'negotiationResultStatus:id,name,color',
        'accuracy:id,name',
        'companion:id,name'
      ])
      ->where('task_id', $taskId)
      ->ordered()
      ->paginated($request->length);
    return TaskProgressResource::collection($taskProgresses);
  }

  /**
   * Create new task progress
   * @param object $request
   * @return json
   */
  public function store(TaskProgressRequest $request)
  {
    $taskProgress = $this->taskProgress->create($request->all());
    
    return response()->json([
      'message' => 'Created successfully!',
      'data' => new TaskProgressResource($taskProgress->load([
        'saleStatus:id,name,color',
        'negotiationStatus:id,name,color',
        'negotiationResultStatus:id,name,color',
        'accuracy:id,name',
        'companion:id,name'
      ]))
    ], 201);
  }

  /**
   * Update task progress
   * @param object $request
   * @param int $id
   * @return json
   */
  public function update(TaskProgressRequest $request, $id)
  {

    $taskProgress = $this->taskProgress->find($id);
    $taskProgress->update($request->all());

    return response()->json([
      'message' => 'Updated successfully!',
      'data' => new TaskProgressResource($taskProgress->load([
        'saleStatus:id,name,color',
        'negotiationStatus:id,name,color',
        'negotiationResultStatus:id,name,color',
        'accuracy:id,name',
        'companion:id,name'
      ]))
    ], 201);
  }

  /**
   * Soft delete task progress.
   *
   * @param  object  $request
   * @return json
   */
  public function softDelete(Request $request)
  {
    $this->taskProgress->destroy($request->ids);

    return response()->json([
      'message' => 'Deleted successfully!',
    ]);
  }
}
