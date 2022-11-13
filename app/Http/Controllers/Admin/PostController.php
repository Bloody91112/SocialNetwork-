<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts', ));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $users = User::all();
        return view('admin.post.create', compact('users', 'categories', 'tags'));
    }

    public function store(StoreRequest $request)
    {
        $this->authorize('create', User::class);
        $data = $request->validated();

        if (isset($data['tags'])){
            $tagsIds = $data['tags'];
            unset($data['tags']);
        }

        $post = Post::create($data);

        if (isset($data['tags'])){
            $post->tags()->attach($tagsIds);
        }
        return redirect()->route('admin.posts.index');
    }

    public function show(Post $post)
    {
        return view('admin.post.show', compact('post' ));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $users = User::all();
        return view('admin.post.edit', compact('post', 'users', 'tags', 'categories'));
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $this->authorize('update', auth()->user());
        $data = $request->validated();

        if (isset($data['tags'])) {
            $tagsIds = $data['tags'];
            unset($data['tags']);
        }

        $post->update($data);

        if(isset($data['tags'])) {
            $post->tags()->sync($tagsIds);
        }

        return redirect()->route('admin.posts.index');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', auth()->user());
        $post->tags()->detach();
        $post->comments()->delete();
        $post->likes()->delete();
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
