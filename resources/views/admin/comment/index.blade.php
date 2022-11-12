@extends('admin.layouts.main')

@section('title')Comments @endsection


@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Comments</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.main.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Comments</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 col-md-12">
                    <div class="card">
                        <div class="card-header"></div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Event</th>
                                    <th>Post</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach( $comments->sortByDesc('created_at') as $comment )
                                    <tr>
                                        <td><a href="{{ route('admin.comments.show', $comment->id) }}">{{ $comment->id }}</a></td>
                                        <td><a href="{{ route('admin.users.show', $comment->user->id) }}">{{ $comment->user->name }}</a></td>
                                        <td><i class="fs-3 fas fa-comment"></i></td>
                                        <td><a href="{{ route('admin.posts.show', $comment->post->id) }}">{{ $comment->post->title }}</a></td>
                                        <td>{{ $comment->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
