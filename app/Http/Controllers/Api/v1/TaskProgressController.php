<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskProgressRequest;
use App\Http\Resources\TaskProgress\TaskProgressResource;
use App\Models\EmployeeTarget;
use App\Models\Task;
use App\Models\TaskProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TaskProgressController extends Controller
{
  protected $taskProgress;
  protected $task;
  protected $employee_target;

  public function __construct(TaskProgress $taskProgress, Task $task, EmployeeTarget $employee_target)
  {
    $this->taskProgress = $taskProgress;
    $this->task = $task;
    $this->employee_target = $employee_target;
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


    #check đã có trạng thái oder ở task truyền vào này chưa, nếu có thì ko cho tạo trạng thái nữa
    $taskProgress_Check_oder = $this->taskProgress
      ->where('task_id', $request->task_id)
      ->where('negotiation_result_status_id', env('ID_NEGOTIATION_RESULT'))
      ->get();

    if (!$taskProgress_Check_oder->isEmpty()) {
      return response()->json(['message' => 'This task status is already oder'], 403);
    }


    try {
      DB::beginTransaction();

      $taskProgress = $this->taskProgress->create($request->all());

      #sau khi check mà chưa có oder mà trạng thái request đưa vào lại là oder thì add tiền vào thành tích nhân viên làm task đó.
      if (($request->negotiation_result_status_id) == env('ID_NEGOTIATION_RESULT')) {
        $date_update = $taskProgress->updated_at;

        $employee_add_achievement = $this->employee_target
          ->where('user_id', $taskProgress->task->user_id)
          ->where('from', 'like', '%' . explode("-", $date_update)[0] . '-' . explode("-", $date_update)[1] . '%')->first();

        # kiem tra user lam task đó đã được tạo mục tiêu chưa. nếu có mục tiêu mới add tiền vào thành tích. còn ko thì thôi
        if (!empty($employee_add_achievement)) {
          $employee_add_achievement->update([
            'achievement' => $employee_add_achievement->achievement += $taskProgress->task->survey_price,
          ]);

          #them thành tích của nhân viên vào mục tiêu tổng theo từng tháng của phong ban chứa nhân viên đó
          $add_achievement_department_targets = $taskProgress->task->user->department->departmenttargets
            ->where('from', explode("-", $date_update)[0] . '-' . explode("-", $date_update)[1] . '-01')->first();

          $add_achievement_department_targets->update([
            'achievement' => $add_achievement_department_targets->achievement += $taskProgress->task->survey_price,
          ]);
        }
      }

      DB::commit();
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
    } catch (\Exception $exception) {
      DB::rollBack();
      log::error('message:' . $exception->getMessage() . 'Line :' . $exception->getLine());
    }
  }

  /**
   * Update task progress
   * @param object $request
   * @param int $id
   * @return json
   */
  public function update(TaskProgressRequest $request, $id)
  {
    try {
      DB::beginTransaction();
      #nếu trường hợp find id có trạng thái là oder, sau khi update lại đổi trạng thái khác với oder thì sẽ tìm thành tích của user đó và trừ tiền thành tích

      $taskProgress = $this->taskProgress->find($id);
      if (($taskProgress->negotiation_result_status_id) == env('ID_NEGOTIATION_RESULT')) {
        $taskProgress->update($request->all());
        $taskProgress_update = $this->taskProgress->find($id);

        if (($taskProgress_update->negotiation_result_status_id) != env('ID_NEGOTIATION_RESULT')) {

          $date_update = $taskProgress->updated_at;

          $employee_add_achievement = $this->employee_target
            ->where('user_id', $taskProgress->task->user_id)
            ->where('from', 'like', '%' . explode("-", $date_update)[0] . '-' . explode("-", $date_update)[1] . '%')->first();

          # kiem tra user lam task đó đã được tạo mục tiêu chưa. nếu có mục tiêu mới add tiền vào thành tích. còn ko thì thôi
          if (!empty($employee_add_achievement)) {
            $employee_add_achievement->update([
              'achievement' => $employee_add_achievement->achievement -= $taskProgress->task->survey_price,
            ]);

            #trừ thành tích của nhân viên ở mục tiêu tổng theo từng tháng của phong ban chứa nhân viên đó
            $add_achievement_department_targets = $taskProgress->task->user->department->departmenttargets
              ->where('from', explode("-", $date_update)[0] . '-' . explode("-", $date_update)[1] . '-01')->first();

            $add_achievement_department_targets->update([
              'achievement' => $add_achievement_department_targets->achievement -= $taskProgress->task->survey_price,
            ]);
          }
        }
      } else {
        $taskProgress->update($request->all());
        $taskProgress_update = $this->taskProgress->find($id);
        if (($taskProgress_update->negotiation_result_status_id) == env('ID_NEGOTIATION_RESULT')) {

          $date_update = $taskProgress_update->updated_at;
          $employee_add_achievement = $this->employee_target
            ->where('user_id', $taskProgress->task->user_id)
            ->where('from', 'like', '%' . explode("-", $date_update)[0] . '-' . explode("-", $date_update)[1] . '%')->first();

          # kiem tra user lam task đó đã được tạo mục tiêu chưa. nếu có mục tiêu mới add tiền vào thành tích. còn ko thì thôi
          if (!empty($employee_add_achievement)) {
            $employee_add_achievement->update([
              'achievement' => $employee_add_achievement->achievement += $taskProgress->task->survey_price,
            ]);

            #them thành tích của nhân viên vào mục tiêu tổng theo từng tháng của phong ban chứa nhân viên đó
            $add_achievement_department_targets = $taskProgress->task->user->department->departmenttargets
              ->where('from', explode("-", $date_update)[0] . '-' . explode("-", $date_update)[1] . '-01')->first();

            $add_achievement_department_targets->update([
              'achievement' => $add_achievement_department_targets->achievement += $taskProgress->task->survey_price,
            ]);
          }
        }
      }

      DB::commit();
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
    } catch (\Exception $exception) {
      DB::rollBack();
      Log::error('message:' . $exception->getMessage() . 'Line :' . $exception->getLine());
    }
  }

  /**
   * Soft delete task progress.
   *
   * @param  object  $request
   * @return json
   */
  public function softDelete(Request $request, $id)
  {


    try {
      DB::beginTransaction();
      $progress_delete = $this->taskProgress->find($id);

      if (($progress_delete->negotiation_result_status_id) == env('ID_NEGOTIATION_RESULT')) {

        $date_update = $progress_delete->updated_at;
        $employee_add_achievement = $this->employee_target
          ->where('user_id', $progress_delete->task->user_id)
          ->where('from', 'like', '%' . explode("-", $date_update)[0] . '-' . explode("-", $date_update)[1] . '%')->first();

        # kiem tra user lam task đó đã được tạo mục tiêu chưa. nếu có mục tiêu mới add tiền vào thành tích. còn ko thì thôi
        if (!empty($employee_add_achievement)) {
          $employee_add_achievement->update([
            'achievement' => $employee_add_achievement->achievement -= $progress_delete->task->survey_price,
          ]);

          #them thành tích của nhân viên vào mục tiêu tổng theo từng tháng của phong ban chứa nhân viên đó
          $add_achievement_department_targets = $progress_delete->task->user->department->departmenttargets
            ->where('from', explode("-", $date_update)[0] . '-' . explode("-", $date_update)[1] . '-01')->first();

          $add_achievement_department_targets->update([
            'achievement' => $add_achievement_department_targets->achievement -= $progress_delete->task->survey_price,
          ]);
        }
      }


      $this->taskProgress->destroy($id);

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
