@extends('admin.layouts.main')

@section('title')Tag {{ $tag->name }} @endsection

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tag {{ $tag->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.main.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.tags.index') }}">Tags</a>
                        </li>
                        <li class="breadcrumb-item active">Tag {{ $tag->name }}</li>
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
                                <div>{{ $tag->name }}</div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-primary">Edit</a>
                            <form class="d-inline" action="{{ route('admin.tags.destroy', $tag->id) }}" method="post">
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
