<?php

namespace App\Http\Resources\API\Comment;

use App\Http\Resources\API\User\UserMinResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'user' => new UserMinResource(User::find($this->user_id)),
            'post_id' => $this->post_id,
            'created_at' => isset($this->created_at) ? $this->created_at->diffForHumans() : null,
        ];
    }
}
