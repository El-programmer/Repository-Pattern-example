<?php

namespace App\Services;

use App\Repositories\DepartmentRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository,
        protected DepartmentRepository $departmentRepository,
    ) {
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        if (request()->hasFile('image')) {
            $data['image_url'] = request()->file('image')->store('users', 'public');
        }
        return $this->userRepository->create($data);
    }

    public function update(array $data, $id)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }else
            unset($data['password']);
        if (request()->hasFile('image')) {
            $data['image_url'] = request()->file('image')->store('users', 'public');
        }
        return $this->userRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }

    public function all($with = [])
    {
        return $this->userRepository->all($with);
    }

    public function find($id)
    {
        return $this->userRepository->find($id);
    }
    public function mangersName()
    {
        return $this->userRepository->mangersName();
    }

    public function selectData(){
        return [
            'managers' => $this->mangersName(),
            'departments' => $this->departmentRepository->list(),
        ];
    }
}
