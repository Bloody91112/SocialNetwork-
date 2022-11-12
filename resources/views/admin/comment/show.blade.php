@extends('admin.layouts.main')

@section('title')Comment {{ $comment->name }} @endsection

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Comment {{ $comment->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.main.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.comments.index') }}">Comments</a>
                        </li>
                        <li class="breadcrumb-item active">Comment {{ $comment->name }}</li>
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
                                <div class="font-weight-bold">Author: </div>
                                <div>
                                    <a href="{{ route('admin.users.show', $comment->user->id) }}">
                                        {{ $comment->user->name }}
                                    </a>
                                </div>
                            </div>

                            <div style="display: flex; column-gap: 8px; align-items: center">
                                <div class="font-weight-bold">Post: </div>
                                <div>
                                    <a href="{{ route('admin.posts.show', $comment->post->id) }}">
                                        {{ $comment->post->title }}
                                    </a>
                                </div>
                            </div>

                            <div style="display: flex; column-gap: 8px; align-items: center">
                                <div class="font-weight-bold">Content: </div>
                                <div>
                                    {{ $comment->content }}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <form class="d-inline" action="{{ route('admin.comments.destroy', $comment->id) }}" method="post">
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
