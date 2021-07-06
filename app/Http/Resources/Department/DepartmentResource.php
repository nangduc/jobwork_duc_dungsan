<?php

namespace App\Http\Resources\Department;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
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
      'id'         => $this->id,
      'parent_id'  => $this->parent_id,
      'name'       => $this->name,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'manager_id' => $this->manager_id,
      'manager'    => $this->manager(),
      'children'   => self::collection($this->children)
    ];
  }

  /**
   * Department manager
   */
  public function manager()
  {
    return [
      'id'        => $this->manager->id,
      'name'      => $this->manager->name,
      'kana_name' => $this->manager->kana_name,
      'username'  => $this->manager->username,
      'avatar'    => $this->manager->avatar ? asset('storage/images/avatars/' . $this->manager->avatar) : asset('images/avatars/avatar.jpg')
    ];
  }
}
