@extends('admin.layouts.main')

@section('title')New post @endsection

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New post</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.main.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.posts.index') }}">Posts</a>
                        </li>
                        <li class="breadcrumb-item active">New post</li>
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
                        <form action="{{ route('admin.posts.store') }}" method="post" >
                            @csrf
                            <div class="card-body">
                                {{--TITLE--}}
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" value="{{ old('title') }}" name="title" class="form-control" id="title" placeholder="Post title">
                                    @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{--CONTENT--}}
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea type="text" name="content" class="form-control"
                                              id="content" placeholder="Post content">{{ old('content') }}</textarea>
                                    @error('content')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{--USER--}}
                                <div class="form-group">
                                    <label>Author</label>
                                    <select name="user_id" class="form-control select2" style="width: 100%;">
                                        <option selected disabled> Choose user</option>
                                        @foreach($users as $user)
                                            <option {{ old('user_id') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
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
                                                {{ old('category_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
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
                                                {{ is_array(old('tags')) && in_array($tag->id, old('tags')) ? 'selected' : '' }}
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
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
