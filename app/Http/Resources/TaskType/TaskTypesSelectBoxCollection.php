<?php

namespace App\Http\Resources\TaskType;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskTypesSelectBoxCollection extends ResourceCollection
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
      'data' => $this->collection->transform(function ($taskGroup) {
        return [
          'id' => $taskGroup->id . '-' . uniqid(),
          'name' => $taskGroup->name,
          'task_types' => $taskGroup->taskTypes,
        ];
      })
    ];
  }
}
