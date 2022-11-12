@extends('admin.layouts.main')

@section('title')Role {{ $role->name }} @endsection

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Role {{ $role->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.main.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.roles.index') }}">Roles</a>
                        </li>
                        <li class="breadcrumb-item active">Role {{ $role->name }}</li>
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
                                <div>{{ $role->name }}</div>
                            </div>

                            <div style="display: flex; column-gap: 8px; align-items: center">
                                <div class="font-weight-bold">Access level: </div>
                                <div>{{ $role->access_level }}</div>
                            </div>

                            <div style="display: flex; column-gap: 8px; align-items: center">
                                <div class="font-weight-bold">Users with role {{ $role->name }}: </div>
                                @foreach($role->users as $user)

                                    <a style="border-radius: 5px; color: black; display:inline-block; padding: 2px 10px; background-color: lightgray; margin: 0 1px;" href="{{ route('admin.users.show', $user->id) }}">
                                        {{ $user->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary">Edit</a>
                            <form class="d-inline" action="{{ route('admin.roles.destroy', $role->id) }}" method="post">
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
