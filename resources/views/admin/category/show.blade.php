@extends('admin.layouts.main')

@section('title')Category {{ $category->name }} @endsection

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category {{ $category->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.main.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.categories.index') }}">Categories</a>
                        </li>
                        <li class="breadcrumb-item active">Category {{ $category->name }}</li>
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
                                <div>{{ $category->name }}</div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                            <form class="d-inline" action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
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
