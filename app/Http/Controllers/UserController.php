<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {
    }

    public function index()
    {
        $users = $this->userService->all(['department' ,'manager']);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $data = $this->userService->selectData();
        return view('users.create',$data);
    }

    public function store(CreateUserRequest $request)
    {

        $this->userService->create($request->validated());

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user' ));
    }

    public function edit(User $user)
    {
        $data = $this->userService->selectData();
        $data['user'] = $user;
        return view('users.edit', $data);
    }

    public function update(UpdateUserRequest $request, User $user)
    {

        $user = $this->userService->update($request->validated(), $user->id);

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $this->userService->delete($id);

        return redirect()->route('users.index');
    }
}
