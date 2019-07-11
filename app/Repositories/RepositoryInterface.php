<?php


namespace App\Repositories;


interface RepositoryInterface
{
    public function all();

    public function store(Array $data);

    public function create();

    public function update(Array $data, $id);

    public function delete($id);

    public function find($id);

}
