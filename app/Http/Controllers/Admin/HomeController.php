<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $usersCount = User::all()->count();
        $postsCount = Post::all()->count();
        $likesCount = Like::all()->count();
        $commentsCount = Comment::all()->count();

        return view('admin.main.index', compact('usersCount', 'postsCount', 'likesCount', 'commentsCount'));
    }
}
