<?php

namespace App\Http\Resources\TaskProgress;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskProgressResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id'                        => $this->id,
      'task_id'                   => $this->task_id,
      'date'                      => $this->date,
      'description'               => $this->description,
      'next_negotiation_date'     => $this->next_negotiation_date,
      'plan_next_time'            => $this->plan_next_time,
      'created_at'                => $this->created_at,
      'sale_status'               => $this->saleStatus,
      'negotiation_status'        => $this->negotiationStatus,
      'negotiation_result_status' => $this->negotiationResultStatus,
      'accuracy'                  => $this->accuracy,
      'companion'                 => $this->companion
    ];
  }
}
