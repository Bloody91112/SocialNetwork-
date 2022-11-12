@extends('admin.layouts.main')

@section('title')Likes @endsection


@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Likes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.main.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Likes</li>
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

                                @foreach( $likes->sortByDesc('created_at') as $like )
                                    <tr>
                                        <td>{{ $like->id }}</td>
                                        <td>
                                            <a href="{{ route('admin.users.show', $like->user->id) }}">
                                                {{ $like->user->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <i class="fs-5 fas fa-heart text-danger"></i>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.posts.show', $like->post->id) }}">
                                                {{ $like->post->title }}
                                            </a>
                                        </td>
                                        <td>{{ $like->created_at }}</td>
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
