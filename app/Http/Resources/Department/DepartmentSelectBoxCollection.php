<?php

namespace App\Http\Resources\Department;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DepartmentSelectBoxCollection extends ResourceCollection
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
      'data' => $this->collection->transform(function ($department) {
        $children = $department->children;
        return [
          'id'       => $department->id,
          'name'     => $department->name,
          'children' => $children->map(function ($child) {
            return [
              'id'   => $child->id,
              'name' => $child->name,
            ];
          })

        ];
      })
    ];
  }
}
