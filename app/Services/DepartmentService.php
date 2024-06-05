<?php

namespace App\Services;

use App\Repositories\DepartmentRepository;

class DepartmentService
{
    public function __construct(
        protected DepartmentRepository $departmentRepository
    ) {
    }

    public function create(array $data)
    {
        return $this->departmentRepository->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->departmentRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->departmentRepository->delete($id);
    }

    public function all($with = [])
    {
        return $this->departmentRepository->all($with);
    }

    public function find($id)
    {
        return $this->departmentRepository->find($id);
    }
    public function mangersName()
    {
        return $this->departmentRepository->mangersName();
    }
}
