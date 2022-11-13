<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Http\Requests\Admin\Tag\UpdateRequest;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tag.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(StoreRequest $request)
    {
        $this->authorize('create',User::class);
        $data = $request->validated();
        Tag::firstOrCreate(['name' => $data['name']]);
        return redirect()->route('admin.tags.index');
    }


    public function show(Tag $tag)
    {
        return view('admin.tag.show', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(UpdateRequest $request, Tag $tag)
    {
        $this->authorize('update', auth()->user());
        $tag->update($request->validated());
        return redirect()->route('admin.tags.index');
    }

    public function destroy(Tag $tag)
    {
        $this->authorize('delete', auth()->user());
        $tag->delete();
        return redirect()->route('admin.tags.index');
    }
}
