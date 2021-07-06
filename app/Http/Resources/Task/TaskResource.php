<?php

namespace App\Http\Resources\task;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    $lastTaskProgresses = $this->taskProgresses->last();
    return [
      'id'                        => $this->id,
      'name'                      => $this->name,
      'description'               => $this->description,
      'survey_price'              => $this->survey_price,
      'insurance_price'           => $this->insurance_price,
      'expected_order_at'         => $this->expected_order_at,
      'user'                      => $this->user,
      'customer'                  => $this->customer,
      'task_type'                 => $this->taskType,
      'created_at'                => $this->created_at,
      'updated_at'                => $this->updated_at,
      'sale_status'               => $lastTaskProgresses ? $lastTaskProgresses->saleStatus : null,
      'negotiation_status'        => $lastTaskProgresses ? $lastTaskProgresses->negotiationStatus : null,
      'negotiation_result_status' => $lastTaskProgresses ? $lastTaskProgresses->negotiationResultStatus : null,
      'accuracy'                  => $lastTaskProgresses ? $lastTaskProgresses->accuracy : null,
      'next_negotiation_date'     => $lastTaskProgresses ? $lastTaskProgresses->next_negotiation_date : null,
      'plan_next_time'            => $lastTaskProgresses ? $lastTaskProgresses->plan_next_time : null,
    ];
  }
}
