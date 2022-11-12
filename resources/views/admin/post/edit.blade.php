@extends('admin.layouts.main')

@section('title')Edit post {{ $post->title }} @endsection

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit post {{ $post->title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.main.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.posts.index') }}">Posts</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.posts.show', $post->id) }}">Post {{ $post->title }}</a>
                        </li>
                        <li class="breadcrumb-item active">Edit post {{ $post->title }} </li>
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
                        <form action="{{ route('admin.posts.update', $post->id) }}" method="post" >
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                {{--TITLE--}}
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" value="{{ $post->title }}" name="title" class="form-control" id="title" placeholder="Post title">
                                    @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{--CONTENT--}}
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea type="text" name="content" class="form-control"
                                              id="content" placeholder="Post content">{{ $post->content }}</textarea>
                                    @error('content')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{--USER--}}
                                <div class="form-group">
                                    <label >Author</label>
                                    <select name="user_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled> Choose category</option>
                                        @foreach($users as $user)
                                            <option
                                                {{ $user->id == $post->user_id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{--CATEGORY--}}
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled> Choose category</option>
                                        @foreach($categories as $category)
                                            <option
                                                {{ $category->id == $post->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{--TAGS--}}
                                <div class="form-group">
                                    <label>Tags</label>
                                    <select name="tags[]" class="select2" multiple="multiple"
                                            data-placeholder="Select tags" style="width: 100%;">
                                        @foreach($tags as $tag )
                                            <option
                                                {{ is_array( $post->tags->pluck('id')->toArray() ) && in_array($tag->id, $post->tags->pluck('id')->toArray() ) ? 'selected' : '' }}
                                                value="{{ $tag->id }}"
                                            >
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tags')
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
