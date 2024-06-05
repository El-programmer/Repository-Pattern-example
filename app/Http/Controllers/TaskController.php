<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Task;
use App\Services\taskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        protected TaskService $taskService
    ) {
    }

    public function index()
    {
        $tasks  = $this->taskService->all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $users = $this->taskService->employees();
        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $inputs = $request->validate([
            'title' => 'required|string|min:2',
            'user_id' => 'required|exists:users,id',
            'description' => 'nullable|string|min:2'
        ]);

        $this->taskService->create($inputs);

        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('department'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('department'));
    }

    public function update(Request $request, Task $task)
    {
        $inputs = $request->validate([
            'title' => 'required|string|min:2',
            'user_id' => 'required|exists:users,id',
            'description' => 'nullable|string|min:2'
        ]);
        $this->taskService->update($inputs, $task->id);

        return redirect()->route('tasks.index');
    }
    public function updateStatus(Request $request)
    {
        $inputs = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'status' => 'required|in:pending,in progress,completed',
        ]);
        $this->taskService->updateStatus($inputs , $inputs['task_id']);

        return redirect()->route('tasks.index');
    }

    public function destroy($id)
    {
        $this->taskService->delete($id);

        return redirect()->route('tasks.index');
    }
}
