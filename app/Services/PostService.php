<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Repositories\UserRepository;

class PostService
{
    public function __construct(
        protected PostRepository $postRepository,
        protected UserRepository $userRepository,
    ) {
    }

    public function create(array $data)
    {
        $data['add_by_id'] = auth()->id();
        $data['status'] = 'pending';
        return $this->taskRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->taskRepository->update($data, $id);
    }
    public function updateStatus(array $data, $id)
    {
        return $this->taskRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->taskRepository->delete($id);
    }

    public function all($with = ['byUser', 'user'])
    {
        return $this->taskRepository->all($with);
    }
    public function pages($with = ['byUser', 'user'])
    {
        return $this->taskRepository->pages($with);
    }

    public function find($id)
    {
        return $this->taskRepository->find($id);
    }
    public function employees()
    {
        return $this->userRepository->myEmployees();
    }
}
