@extends('layouts.app')

@section('content')
    <link role="stylesheet" href="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.min.js">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-2">
        <h1>Edit Posts</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
    </div>
    <table class="table table-bordered" id="datatable">
        <thead>
        <tr>
            <th>Title</th>
            <th>By User</th>
            <th>created at</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.min.js"></script>


    <script>
        $(document).ready(function () {
            $('#datatable').DataTable({
                ordering: false,
                processing: true,
                serverSide: true,
                responsive: true,
                "ajax": {
                    url: "{{route('posts.index')}}",
                    data: function (filterData) {
                        $('.datatable-filter').each(function () {
                            let name = $(this).attr('name');  // Get the 'name' attribute
                            let value = $(this).val();        // Get the input's value
                            filterData[name] = value;         // Add name-value pair to filterData
                        });
                    }
                },
                columns: [
                        @foreach($columns as $key => $column)
                    {
                        data: '{{$key}}',
                        name: '{!! $column[0] !!}',
                    },
                        @endforeach
                    {
                        data: 'actions',
                        searchable: false,
                        orderable: false
                    }
                ]
            });

            $(document).on('change', '.filter, .datatable-filter', function () {
                $("#datatable").DataTable().ajax.reload();
            });
        });

    </script>
@endsection
