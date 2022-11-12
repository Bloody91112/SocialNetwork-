@extends('admin.layouts.main')

@section('title')Post {{ $post->title }} @endsection

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Post {{ $post->title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.main.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.posts.index') }}">Posts</a>
                        </li>
                        <li class="breadcrumb-item active">Post {{ $post->title }}</li>
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

                            {{--TITLE--}}
                            <div style="display: flex; column-gap: 8px; align-items: center">
                                <div class="font-weight-bold">Title:</div>
                                <div>{{ $post->title }}</div>
                            </div>

                            {{--CONTENT--}}
                            <div>
                                <div class="font-weight-bold">Content:</div>
                                <div>{{ $post->content }}</div>
                            </div>

                            {{--AUTHOR--}}
                            <div style="display: flex; column-gap: 8px; align-items: center">
                                <div class="font-weight-bold">Author:</div>
                                <div>{{ $post->user->name }}</div>
                            </div>

                            {{--LIKES--}}
                            <div style="display: flex; column-gap: 8px; align-items: center">
                                <div class="font-weight-bold">Likes:</div>
                                <div>{{ $post->likes->count() }} <i class="fas fa-heart ml-1 text-danger"></i></div>
                            </div>


                            {{--CATEGORIES--}}
                            @if($post->category)
                                <div><p class="d-inline font-weight-bold">Category: </p>{{ $post->category->name }}
                                </div>
                            @endif

                            {{--TAGS--}}
                            @if($post->tags->count() > 0)
                                <div><p class="d-inline font-weight-bold">Tags: </p>
                                    <div class="d-inline-flex">
                                        @foreach($post->tags as $tag)
                                            <div
                                                style="color: black; margin: 0 5px; padding: 1px 5px; background-color:lightgray; border-radius: 5px;"> {{ $tag->name }} </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{--COMMENTS--}}
                            @if($post->comments->count() > 0)
                                <div><p class="d-inline font-weight-bold">Comments: </p></div>
                                @foreach($post->comments as $comment)
                                    <div class="card card-dark">
                                        <div class="card-header">
                                            <a href="{{ route('admin.users.show', $comment->user->id) }}">
                                                {{ $comment->user->name }}
                                            </a>
                                            <span>writes:</span>
                                        </div>
                                        <div class="card-body">
                                            {{ $comment->content }}
                                        </div>
                                        <div class="card-footer">{{ $comment->created_at }}</div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                            <form class="d-inline" action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
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
