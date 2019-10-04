<?php

namespace App\Repositories;

use App\PostTO;
use App\UserTO;

interface PostRepositoryInterface
{

    public function all();

    public function store(PostTO $post);

    public function create();

    public function update(Array $data, $id);

    public function delete($id);

    public function find($id);

    public function allPostbyUser(UserTO $userTO);
}