<?php

namespace App\Http\Resources\Department;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DepartmentCollection extends ResourceCollection
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
        return [
          'id'         => $department->id,
          'parent_id'  => $department->parent_id,
          'name'       => $department->name,
          'created_at' => $department->created_at,
          'updated_at' => $department->updated_at,
          'manager_id' => $department->manager_id,
          'children'   => $department->children->map(function ($child) {
            return [
              'id'         => $child->id,
              'parent_id'  => $child->parent_id,
              'name'       => $child->name,
              'created_at' => $child->created_at,
              'updated_at' => $child->updated_at,
              'manager_id' => $child->manager_id,
              'manager'    => $this->manager($child)
            ];
          }),
          'manager' => $this->manager($department)
        ];
      })
    ];
  }

  /**
   * Department manager
   */
  public function manager($model)
  {
    return [
      'id'        => $model->manager->id,
      'name'      => $model->manager->name,
      'kana_name' => $model->manager->kana_name,
      'username'  => $model->manager->username,
      'avatar'    => $model->manager->avatar ? asset('storage/images/avatars/' . $model->manager->avatar) : asset('images/avatars/avatar.jpg')
    ];
  }
}
