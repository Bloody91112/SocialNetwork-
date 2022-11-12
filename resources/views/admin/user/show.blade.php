@extends('admin.layouts.main')

@section('title')User {{ $user->name }} @endsection

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User {{ $user->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.main.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.users.index') }}">Users</a>
                        </li>
                        <li class="breadcrumb-item active">User {{ $user->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div style="display: flex; column-gap: 8px; align-items: center">
                                <div class="font-weight-bold">Name: </div>
                                <div>{{ $user->name }}</div>
                            </div>

                            <div style="display: flex; column-gap: 8px; align-items: center">
                                <img width="150px" src="{{ url('storage/' . $user->avatar) }}" alt="avatar">
                            </div>

                            <div style="display: flex; column-gap: 8px; align-items: center">
                                <div class="font-weight-bold">Role: </div>
                                <div>{{ $user->role->name }}</div>
                            </div>

                            <div style="display: flex; column-gap: 8px; align-items: center">
                                <div class="font-weight-bold">Email: </div>
                                <div>{{ $user->email }}</div>
                            </div>

                            <div style="display: flex; column-gap: 8px; align-items: center">
                                <div class="font-weight-bold">Age: </div>
                                <div>{{ $user->age }}</div>
                            </div>

                            <div style="display: flex; column-gap: 8px; align-items: center">
                                <div class="font-weight-bold">Gender: </div>
                                <div>{{ $user->gender }}</div>
                            </div>

                            @if($user->subscriptions->count() > 0)
                                <div><p class="d-inline font-weight-bold">Subscriptions: </p>
                                    <div class="d-inline-flex">
                                        @foreach($user->subscriptions as $subscription)
                                            <a href="{{ route('admin.users.show', $subscription->friend_id ) }}" style="color: black; display: block; margin: 0 5px; padding: 1px 5px; background-color:lightgray; border-radius: 5px;">
                                                 {{$users_list->where('id', $subscription->friend_id)->first()->name}}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif


                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                            <form class="d-inline" action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
