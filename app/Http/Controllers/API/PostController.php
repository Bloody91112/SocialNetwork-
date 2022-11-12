<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\API\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::paginate(20)->sortByDesc('created_at');
        return PostResource::collection($posts);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        if (isset($data['tags'])){
            $tagsIds = $data['tags'];
            unset($data['tags']);
        }

        $post = Post::create($data);

        if (isset($tagsIds)){
            $post->tags()->attach($tagsIds);
        }


        return new PostResource($post);
    }

    public function show(Post $post)
    {
        //
    }


    public function edit(Post $post)
    {
        //
    }

    public function update(UpdateRequest $request, Post $post)
    {
        //
    }


    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->comments()->delete();
        $post->likes()->delete();
        $post->delete();
        return response()->json(['message' => 'deleted']);
    }
}
