@extends('admin.layouts.main')

@section('title')Posts @endsection


@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Posts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.main.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Posts</li>
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
                        <div class="card-header">
                            <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">Add</a>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Event</th>
                                    <th>Post title</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach( $posts->sortByDesc('created_at') as $post )
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.show',$post->user_id ) }}">
                                                {{ $post->user->name }}
                                            </a>
                                        </td>
                                        <td><i class="fs-3 fas fa-share"></i></td>
                                        <td><a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a></td>

                                        <td>{{ $post->created_at }}</td>
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
