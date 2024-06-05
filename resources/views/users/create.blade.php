@extends('layouts.app')

@section('content')
    <div class="mt-4 mb-2">
        <h1>Add Employee</h1>
    </div>
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="row row-cols-md-2">
        @csrf
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
            @error('phone')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label>password </label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="" required>
            @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
            @error('first_name')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
            @error('last_name')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label>Salary</label>
            <input type="number" name="salary" class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary') }}" required>
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
                    <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>{{ $role }}</option>
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
                    <option value="{{ $manager->id }}" {{ old('manager_id') == $manager->id ? 'selected' : '' }}>{{ $manager->full_name }}</option>
                @endforeach
            </select>
            @error('manager_id')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="department_id">Department</label>
            <select name="department_id" class="form-control @error('manager_id') is-invalid @enderror">
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                @endforeach
            </select>
            @error('manager_id')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Add Employee</button>
    </form>
@endsection
