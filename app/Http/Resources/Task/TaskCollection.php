<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollection extends ResourceCollection
{
  /**
   * Transform the resource collection into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'data' => $this->collection->transform(function ($task) {
        $lastTaskProgresses = $task->taskProgresses->last();
        return [
          'id'                        => $task->id,
          'name'                      => $task->name,
          'description'               => $task->description,
          'expected_order_at'         => $task->expected_order_at,
          'created_at'                => $task->created_at,
          'user'                      => $task->user,
          'customer'                  => $task->customer,
          'task_type'                 => $task->taskType,
          'sale_status'               => $lastTaskProgresses ? $lastTaskProgresses->saleStatus : null,
          'negotiation_status'        => $lastTaskProgresses ? $lastTaskProgresses->negotiationStatus : null,
          'negotiation_result_status' => $lastTaskProgresses ? $lastTaskProgresses->negotiationResultStatus : null,
          'accuracy'                  => $lastTaskProgresses ? $lastTaskProgresses->accuracy : null,
          'companion'                 => $lastTaskProgresses ? $lastTaskProgresses->companion : null,
        ];
      }),
    ];
  }
}
