@extends('layouts.app')

@section('content')
    <div class="mt-4 mb-2">
        <h1>Add posts</h1>
    </div>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="row row-cols-md-2">
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" name="title" class="form-control" required>
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Status</label>
                <select class="form-control" name="status">
                    <option value="1">Active</option>
                    <option value="0">unActive</option>
                </select>
                @error('status')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
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
