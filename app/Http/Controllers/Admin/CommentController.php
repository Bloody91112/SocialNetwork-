<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::all();
        return view('admin.comment.index', compact('comments'));
    }


    public function show(Comment $comment)
    {
        return view('admin.comment.show', compact('comment'));
    }


    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index');
    }
}
