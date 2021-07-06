<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskProgress;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\Task\TaskCollection;
use App\Http\Resources\task\TaskResource;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
  protected $task;
  protected $taskProgress;

  public function __construct(Task $task, TaskProgress $taskProgress)
  {
    $this->task         = $task;
    $this->taskProgress = $taskProgress;
  }

  /**
   * Hiển thị tất cả các tasks
   * @param object $request
   * @return json
   */
  public function index(Request $request)
  {
    $tasks = $this->task->getTasks(['search' => $request->search, 'length' => $request->length]);
    return new TaskCollection($tasks);
  }

  /**
   * Hiển thị các tasks của user
   * @param object $request
   * @param int $userId
   * @return json
   */
  public function getTasksByUserId(Request $request, $userId)
  {
    $tasks = $this->task
      ->where('user_id', $userId)
      ->getTasks(['search' => $request->search, 'length' => $request->length]);
    return new TaskCollection($tasks);
  }

  public function getTasksByCustomerId(Request $request, $customerId)
  {
    $tasks = $this->task
      ->where('customer_id', $customerId)
      ->getTasks(['search' => $request->search, 'length' => $request->length]);
    return new TaskCollection($tasks);
  }

  /**
   *
   */
  public function show($id)
  {
    $task = Task::with([
      'user:id,name,kana_name,username,email,job_title',
      'customer:id,name,kana_name',
      'taskType:id,task_group_id,name'
    ])->find($id);
    return new TaskResource($task);
  }

  /**
   * Create new task
   * @param object $request
   * @return json
   */
  public function store(TaskRequest $request)
  {
    DB::beginTransaction();
    try {
      $taskData         = $request->only('user_id', 'name', 'description', 'customer_id', 'task_type_id');
      $taskProgressData = $request->only('date', 'sale_status_id', 'negotiation_status_id', 'accuracy_id', 'companion_id');
      $task             = $this->task->create($taskData);
      $task->taskProgresses()->create($taskProgressData);

      DB::commit();
      return response()->json([
        'message' => 'Created successfully!',
      ], 201);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['message' => $th->getMessage()], 400);
    }
  }

  /**
   * Update task
   */
  public function update(TaskRequest $request, $id)
  {
    DB::beginTransaction();
    try {
      $taskData         = $request->only('user_id', 'name', 'description', 'customer_id', 'task_type_id');
      $taskProgressData = $request->only('sale_status_id', 'negotiation_status_id', 'accuracy_id', 'companion_id');
      $task             = $this->task->find($id);
      $task->update($taskData);

      if (count($task->taskProgresses) > 0) {
        $task->taskProgresses->last()->update($taskProgressData);
      }

      DB::commit();
      return response()->json([
        'message' => 'Updated successfully!',
      ]);
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
    $this->task->destroy($request->ids);

    return response()->json([
      'message' => 'Deleted successfully!',
    ]);
  }
}
