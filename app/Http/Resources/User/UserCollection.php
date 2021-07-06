<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
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
          'data' => $this->collection->transform(function ($user) {
            return [
              'id'            => $user->id,
              'name'          => $user->name,
              'kana_name'     => $user->kana_name,
              'username'      => $user->username,
              'email'         => $user->email,
              'phone'         => $user->phone,
              'birthday'      => $user->birthday,
              'job_title'     => $user->job_title,
              'avatar'        => $user->avatar ? asset('storage/images/avatars/' . $user->avatar) : asset('images/avatars/avatar.jpg'),
              'active'        => $user->active,
              'department_id' => $user->department_id,
              'role'          => $user->roles->first()->id
            ];
          })
        ];
    }
}
