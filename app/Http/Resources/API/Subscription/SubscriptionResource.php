<?php

namespace App\Http\Resources\API\Subscription;

use App\Http\Resources\API\User\UserMinResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
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
            'user_id' => $this->user_id,
            'friend' => new UserMinResource( User::find($this->friend_id) ),
        ];
    }
}
