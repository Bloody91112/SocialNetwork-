<?php

namespace App\Http\Resources\API\User;

use App\Http\Resources\API\Subscription\SubscriptionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserMinResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
