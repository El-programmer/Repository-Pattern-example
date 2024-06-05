@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mt-4 mb-2">
        <h1>tasks</h1>
        @if(auth()->user()->isManager())
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add task</a>
        @endif
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>status</th>
            <th>User</th>
            <th>By User</th>
            <th>created at</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->status }}</td>
                <td>{{ $task->user->full_name??'' }}</td>
                <td>{{ $task->byUser->full_name??'' }}</td>
                <td>{{ $task->created_at }}</td>
                <td>

                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#statusModal" data-taskid="{{ $task->id }}">Change Status</button>

                @if($task->add_by_id == auth()->id())
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" {{ $task->employees_count > 0 ? 'disabled' : '' }}>Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No data</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <!-- Status Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Change Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="statusForm" action="{{route('tasks.updateStatus')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <input name="task_id" value="" id="task_id">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending">Pending</option>
                                <option value="in progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Status Modal -->

@endsection

@section('script')
    <script>
        $('#statusModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var taskId = button.data('taskid');
            $("#task_id").val(taskId);
            var modal = $(this);
            // modal.find('#statusForm').attr('action', '/tasks/' + taskId);
        });
    </script>
@endsection
