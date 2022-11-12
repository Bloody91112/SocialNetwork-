<?php

namespace App\Http\Resources\API\User;

use App\Http\Resources\API\Like\LikeResource;
use App\Http\Resources\API\Subscription\SubscriptionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserInitResource extends JsonResource
{

    public function toArray($request)
    {


        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role->name,
            'subscriptions' => isset($this->subscriptions) ? SubscriptionResource::collection($this->subscriptions) : null,
            'likes' => isset($this->likes) ? LikeResource::collection($this->likes) : null
        ];
    }
}
