@extends('layouts.app')

@section('content')
    <div class="mt-4 mb-2">
        <h1>Add Department</h1>
    </div>
    <form action="{{ route('departments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection
