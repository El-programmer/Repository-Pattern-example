@extends('layouts.app')

@section('content')
    <div class="mt-4 mb-2">
        <h1>Add tasks</h1>
    </div>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Title</label>
            <input type="text" name="title" class="form-control" required>
            @error('title')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description"></textarea>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="manager_id">Manager</label>
            <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->full_name }}</option>
                @endforeach
            </select>
            @error('user_id')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection
