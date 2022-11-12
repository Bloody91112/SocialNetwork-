<?php

namespace App\Http\Resources\API\User;

use App\Http\Resources\API\Comment\CommentResource;
use App\Http\Resources\API\Like\LikeResource;
use App\Http\Resources\API\Post\PostResource;
use App\Http\Resources\API\Subscription\SubscriptionResource;
use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {

        $posts = Post::where('user_id', $this->id)->get();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role->name,
            'gender' => $this->gender ?? null,
            'age' => $this->age ?? null,
            'subscriptions' => isset($this->subscriptions) ? SubscriptionResource::collection($this->subscriptions) : null,
            'likes' => isset($this->likes) ? LikeResource::collection($this->likes) : null,
            'posts' => isset($posts) ? PostResource::collection($posts) : null,
            'comments' => isset($this->comments) ? CommentResource::collection($this->comments) : null,
            'created_at' => $this->created_at->diffForHumans(),
            'avatar' => $this->avatarUrl,
        ];
    }
}
