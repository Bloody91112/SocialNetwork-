@extends('admin.layouts.main')

@section('title')Edit role {{ $role->name }} @endsection

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit role {{ $role->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.main.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.roles.index') }}">Roles</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.roles.show', $role->id) }}">Role {{ $role->name }}</a>
                        </li>
                        <li class="breadcrumb-item active">Edit role {{ $role->name }} </li>
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
                        <form action="{{ route('admin.roles.update', $role->id) }}" method="post" >
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{ $role->name }}" name="name" class="form-control" id="name" placeholder="Role name">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="access_level">Access level</label>
                                    <input type="number" value="{{ $role->access_level }}" name="access_level" class="form-control" id="access_level" placeholder="Role access level">
                                    @error('access_level')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
