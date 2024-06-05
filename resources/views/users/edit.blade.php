@extends('layouts.app')

@section('content')
    <div class="mt-4 mb-2">
        <h1>Edit Employee</h1>
    </div>
    <div class="text-center justify-content-center">

        <div>
            <img src="{{ $user->img_url }}" alt="Image" width="50">
            <div>{{ $user->full_name }}</div>
            <p>#{{ $user->id }}</p>
        </div>
    </div>
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="row row-cols-md-2">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" required>
            @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone }}" required>
            @error('phone')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ $user->first_name }}" required>
            @error('first_name')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ $user->last_name }}" required>
            @error('last_name')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Salary</label>
            <input type="number" name="salary" class="form-control @error('salary') is-invalid @enderror" value="{{ $user->salary }}" required>
            @error('salary')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control @error('role') is-invalid @enderror">
                @foreach (['employee','manager'] as $role)
                    <option value="{{ $role }}" {{ $user->role == $role ? 'selected' : '' }}>{{ $role }}</option>
                @endforeach
            </select>
            @error('role')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="manager_id">Manager</label>
            <select name="manager_id" class="form-control @error('manager_id') is-invalid @enderror">
                <option value="">None</option>
                @foreach ($managers as $manager)
                    <option value="{{ $manager->id }}" {{ $user->manager_id == $manager->id ? 'selected' : '' }}>{{ $manager->full_name }}</option>
                @endforeach
            </select>
            @error('manager_id')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="department_id">Department</label>
            <select name="department_id" class="form-control @error('department_id') is-invalid @enderror">
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                @endforeach
            </select>
            @error('department_id')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update Employee</button>
    </form>
@endsection
