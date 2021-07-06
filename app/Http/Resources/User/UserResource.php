<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
      'name'       => $this->name,
      'kana_name'  => $this->kana_name,
      'username'   => $this->username,
      'email'      => $this->email,
      'phone'      => $this->phone,
      'birthday'   => $this->birthday,
      'job_title'  => $this->job_title,
      'avatar'     => $this->avatar ? asset('storage/images/avatars/' . $this->avatar) : asset('images/avatars/avatar.jpg'),
      'active'     => $this->active,
      'created_at' => $this->created_at,
      'department' => $this->department
    ];
  }
}
