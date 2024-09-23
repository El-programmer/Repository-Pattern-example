@extends('layouts.app')

@section('content')
    <link role="stylesheet" href="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.min.js">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-2">
        <h1>Posts</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
    </div>
    <table class="table table-bordered" id="datatable">
        <thead>
        <tr>
            <th>Title</th>
            <th>By User</th>
            <th>Created at</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

@endsection

@include('layouts.datatable-scripts' ,['route' => route('posts.index') , 'column' => $column])
