<?php

namespace App\Repositories;

use App\User;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    /**
     * PostRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function all()
    {
        $this->model->all();
    }

    public function store(User $user)
    {
        return $this->model->create($user);
    }

    public function create()
    {

    }

    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        if (null == $user = $this->model->find($id)) {
            throw new ModelNotFoundException("User not found");
        }
        return $user;
    }
}
