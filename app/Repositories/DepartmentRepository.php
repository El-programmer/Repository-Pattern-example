<?php
namespace App\Repositories;

use App\Models\Department;
use App\Models\User;

class DepartmentRepository implements BaseRepositoryInterface
{
    public $model = Department::class;
    public function all($with = [])
    {
        return $this->model::with($with)
            ->withCount('users')
            ->withSum('users' ,'salary')->get();
    }
    public function list($with = [])
    {
        return $this->model::get();
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function update(array $data, $id)
    {
        $user = $this->model::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = $this->model::findOrFail($id);
        $user->delete();
    }

    public function find($id)
    {
        return $this->model::findOrFail($id);
    }
    public function findWithoutFail($id)
    {
        return $this->model::find($id);
    }
    public function mangersName()
    {
        return $this->model::where('role' , 'manager')->select('first_name','last_name' ,'id')->get();
    }
}
