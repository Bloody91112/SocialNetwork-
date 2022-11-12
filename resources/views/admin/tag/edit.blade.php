@extends('admin.layouts.main')

@section('title')Edit tag {{ $tag->name }} @endsection

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit tag {{ $tag->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.main.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.tags.index') }}">Tags</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.tags.show', $tag->id) }}">Tag {{ $tag->name }}</a>
                        </li>
                        <li class="breadcrumb-item active">Edit tag {{ $tag->name }} </li>
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
                        <form action="{{ route('admin.tags.update', $tag->id) }}" method="post" >
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{ $tag->name }}" name="name" class="form-control" id="name" placeholder="Tag name">
                                    @error('name')
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
