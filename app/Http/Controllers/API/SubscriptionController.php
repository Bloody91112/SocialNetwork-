<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\StoreRequest;
use App\Http\Resources\API\Subscription\SubscriptionResource;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $sub = Subscription::firstOrCreate( [ 'user_id' => $data['user_id'], 'friend_id' => $data['friend_id'] ],  $data);
        return new SubscriptionResource($sub);
    }


    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return response()->json(['message' => 'deleted']);
    }
}
