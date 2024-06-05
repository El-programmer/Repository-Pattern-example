@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mt-4 mb-2">
        <h1>Employees</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Add New</a>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Role</th>
            <th>Department</th>
            <th>Salary</th>
            <th>Manager Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $employee)
            <tr>
                <td>
                    <img src="{{ $employee->img_url }}" alt="Image" width="50">
                    <span>#{{ $employee->id }}</span>
                </td>
                <td>{{ $employee->full_name }}</td>
                <td>{{ $employee->role }}</td>
                <td>{{  $employee->department->name??'' }}</td>
                <td>{{ $employee->salary }}</td>
                <td>{{  $employee->manager->full_name??'' }}</td>
                <td>
                    <a href="{{ route('users.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('users.destroy', $employee->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
