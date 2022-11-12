<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index(){
        $likes = Like::all();
        return view('admin.like.index',  compact('likes'));
    }
}
