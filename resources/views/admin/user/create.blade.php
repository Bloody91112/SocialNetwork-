@extends('admin.layouts.main')

@section('title')New user @endsection

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New user</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.main.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.users.index') }}">Users</a>
                        </li>
                        <li class="breadcrumb-item active">New user</li>
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
                        <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data" >
                            @csrf

                            <div class="card-body">

                                {{--NAME--}}
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="name" placeholder="Name">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{--EMAIL--}}
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" value="{{ old('email') }}" name="email" class="form-control" id="email" placeholder="Email">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{--PASSWORD--}}
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" value="{{ old('password') }}" name="password" class="form-control" id="password" placeholder="Password">
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{--ROLE--}}
                                <div class="form-group">
                                    <label for="role" >Role</label>
                                    <select id="role" name="role_id" class="form-control select2" style="width: 100%;">
                                        @foreach($roles as $role)
                                            <option {{ old('role') == $role->id ? 'selected' : '' }}
                                                    value="{{ $role->id }}">
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{--AVATAR--}}
                                <div class="form-group">
                                    <label for="avatar">Avatar</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="avatar" type="file" class="custom-file-input" id="avatar">
                                            <label class="custom-file-label" for="avatar">Choose avatar</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    @error('avatar')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{--AGE--}}
                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="number" value="{{ old('age') }}" name="age" class="form-control" id="age" placeholder="Age">
                                    @error('age')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{--GENDER--}}
                                <div class="form-group">
                                    <label for="gender" >Gender</label>
                                    <select id="gender" name="gender" class="form-control select2" style="width: 100%;">
                                            <option {{ old('gender') == 'male' ? 'selected' : '' }} value="male">Male</option>
                                            <option {{ old('gender') == 'female' ? 'selected' : '' }} value="female">Female</option>
                                    </select>
                                    @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
