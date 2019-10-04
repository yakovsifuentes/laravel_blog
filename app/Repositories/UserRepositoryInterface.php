<?php

namespace App\Repositories;

use App\User;

interface UserRepositoryInterface
{
    public function all();

    public function store(User $user);

    public function create();

    public function update(Array $data, $id);

    public function delete($id);

    public function find($id);
}
