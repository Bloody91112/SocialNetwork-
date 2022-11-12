<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Like\StoreRequest;

use App\Http\Resources\API\Like\LikeResource;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{


    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $like = Like::firstOrCreate([ 'user_id' => $data['user_id'], 'post_id' => $data['post_id'] ], $data);
        return new LikeResource($like);
    }


    public function destroy(Like $like)
    {
        $like->delete();
        return response()->json(['message' => 'deleted']);
    }
}
