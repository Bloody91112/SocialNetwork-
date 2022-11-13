<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.category.create');
    }


    public function store(StoreRequest $request)
    {
        $this->authorize('create', User::class);
        $data = $request->validated();
        Category::firstOrCreate(['name' => $data['name']]);
        return redirect()->route('admin.categories.index');
    }


    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }


    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }


    public function update(UpdateRequest $request, Category $category)
    {
        $this->authorize('update', auth()->user());
        $category->update($request->validated());
        return redirect()->route('admin.categories.index');
    }


    public function destroy(Category $category)
    {
        $this->authorize('delete', auth()->user());
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
