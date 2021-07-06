<?php

namespace App\Http\Resources\Companion;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CompanionsCollection extends ResourceCollection
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
      'data' => $this->collection->transform(function ($companion) {
        return [
          'id' => $companion->id,
          'name' => $companion->name,
          'avatar' => $companion->avatar ? asset('storage/images/companions/' . $companion->avatar) : asset('storage/images/companions/default.jpg'),
          'created_at' => $companion->created_at
        ];
      })
    ];
  }
}
