@extends('layouts.app')

@section('content')
    <div class="mt-4 mb-2">
        <h1>Edit Post</h1>
    </div>
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row row-cols-md-2">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" title="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Status</label>
                <select class="form-control" name="status">
                    <option value="1" {{$post->status == 1 ?'selected':''}}>Active</option>
                    <option value="0" {{$post->status == 0 ?'selected':''}}>unActive</option>
                </select>
                @error('status')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="content">content</label>
            <textarea name="content">{{$post->content}}</textarea>
            @error('content')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
