<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct(
        protected DepartmentService $departmentService
    ) {
    }

    public function index()
    {
        $departments  = $this->departmentService->all();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $inputs = $request->validate([
           'name' => 'required|string|min:2'
        ]);

        $this->departmentService->create($inputs);

        return redirect()->route('departments.index');
    }

    public function show(Order $department)
    {
        return view('departments.show', compact('department'));
    }

    public function edit(Order $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Order $department)
    {
        $inputs = $request->validate([
            'name' => 'required|string|min:2'
        ]);
        $this->departmentService->update($inputs, $department->id);

        return redirect()->route('departments.index');
    }

    public function destroy($id)
    {
        $this->departmentService->delete($id);

        return redirect()->route('departments.index');
    }
}
