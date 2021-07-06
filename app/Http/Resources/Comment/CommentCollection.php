<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentCollection extends ResourceCollection
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
        'data' => $this->collection->transform(function ($comment) {
          return [
            'id'          => $comment->id,
            'user_id'     => $comment->user_id,
            'user'        => [
              'id'        => $comment->user->id,
              'name'      => $comment->user->name,
              'kana_name' => $comment->user->kana_name,
              'username'  => $comment->user->username,
              'avatar'    => $comment->user->avatar ? asset('storage/images/avatars/' . $comment->user->avatar) : asset('images/avatars/avatar.jpg'),
            ],
            'report_id'   => $comment->report_id,
            'message'     => $comment->message,
            'created_at'  => $comment->created_at
          ];
        })
      ];
    }
}
