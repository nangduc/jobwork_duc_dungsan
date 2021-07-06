<?php

namespace App\Http\Resources\Report;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ReportCollection extends ResourceCollection
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
      'data' => $this->collection->transform(function ($report) {
        return [
          'id'         => $report->id,
          'created_at' => $report->created_at,
          'user'       => $report->user,
        ];
      }),
    ];
  }
}
