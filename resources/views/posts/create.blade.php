@extends('layouts.app')

@section('content')
    <div class="mt-4 mb-2">
        <h1>Add posts</h1>
    </div>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Title</label>
            <input type="text" name="title" class="form-control" required>
            @error('title')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="content">content</label>
            <textarea name="content"></textarea>
            @error('content')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection
