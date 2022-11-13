<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRequest;
use App\Http\Requests\Admin\Role\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }


    public function create()
    {
        return view('admin.role.create');
    }


    public function store(StoreRequest $request)
    {
        $this->authorize('create', User::class);
        $data = $request->validated();
        Role::firstOrCreate(['name' => $data['name']]);
        return redirect()->route('admin.roles.index');
    }


    public function show(Role $role)
    {
        return view('admin.role.show', compact('role', ));
    }


    public function edit(Role $role)
    {
        return view('admin.role.edit', compact('role'));
    }


    public function update(UpdateRequest $request, Role $role)
    {
        $this->authorize('update', auth()->user());
        $role->update($request->validated());
        return redirect()->route('admin.roles.index');
    }


    public function destroy(Role $role)
    {
        $this->authorize('delete', auth()->user());
        $role->delete();
        return redirect()->route('admin.roles.index');
    }
}
