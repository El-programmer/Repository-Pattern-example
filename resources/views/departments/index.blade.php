@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mt-4 mb-2">
        <h1>Departments</h1>
        <a href="{{ route('departments.create') }}" class="btn btn-primary">Add Department</a>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Employee Count</th>
            <th>Total Salary</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($departments as $department)
            <tr>
                <td>{{ $department->id }}</td>
                <td>{{ $department->name }}</td>
                <td>{{ $department->users_count }}</td>
                <td>{{ $department->users_sum_salary }}</td>
                <td>
                    <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" {{ $department->employees_count > 0 ? 'disabled' : '' }}>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
