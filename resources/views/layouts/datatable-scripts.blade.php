@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#{{$id??'datatable'}}').DataTable({
                ordering: false,
                processing: true,
                serverSide: true,
                responsive: true,
                "ajax": {
                    url: "{{$route}}",
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
                        name: '{{$column}}',
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
                $("#{{$id??'datatable'}}").DataTable().ajax.reload();
            });
        });

    </script>

@endsection
