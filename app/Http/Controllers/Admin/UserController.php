<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users', ));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(StoreRequest $request)
    {
        $this->authorize('create', User::class);
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);
        if (isset($data['avatar'])){
            $data['avatar'] = Storage::disk('public')->put('/images', $data['avatar']);
        } else {
            $data['avatar'] = 'images/user.png';
        }
        User::create($data);
        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        $users_list = User::all();
        return view('admin.user.show', compact('user', 'users_list'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $users_list = User::all();
        return view('admin.user.edit', compact('user', 'roles', 'users_list'));
    }


    public function update(UpdateRequest $request, User $user)
    {
        $this->authorize('update', auth()->user());
        $data = $request->validated();

        if (isset($data['avatar'])){
            $data['avatar'] = Storage::disk('public')->put('/images', $data['avatar']);
        } elseif (isset($data['avatar_old'])){
            $data['avatar'] = $data['avatar_old'];
            unset($data['avatar_old']);
        } else {
            $data['avatar'] = 'images/user.png';
        }

        if (isset($data['avatar_old'])) unset($data['avatar_old']);

        $user->update($data);
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', auth()->user());
        Subscription::where('friend_id', $user->id)->delete();
        $user->subscriptions()->delete();

        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
