<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\SortRequest;
use App\Http\Resources\API\Post\PostResource;
use App\Models\Post;
use App\Models\Subscription;
use Illuminate\Http\Request;

class PostSortController extends Controller
{
    public function __invoke(SortRequest $request)
    {
        $data = $request->validated();

        switch ($data['sortValue']){
            case 'all':
                $posts = Post::paginate(20)->sortByDesc('created_at');
                return PostResource::collection($posts);
            case 'pop':
                $postsWithLikesCount = Post::withCount('likes')->paginate(20);
                $posts = $postsWithLikesCount->where('likes_count', '>', 0)->sortByDesc('created_at')->all();
                return PostResource::collection($posts);
            case 'mine':
                $posts = Post::where('user_id', '=', auth()->user()->id)->paginate(20)->sortByDesc('created_at');
                return PostResource::collection($posts);
            case 'sub':
                $subscriptions = Subscription::where('user_id', auth()->user()->id)->pluck('friend_id')->sortByDesc('created_at');
                $posts = Post::whereIn('user_id', $subscriptions)->paginate(20);
                return PostResource::collection($posts);
        }
    }
}
