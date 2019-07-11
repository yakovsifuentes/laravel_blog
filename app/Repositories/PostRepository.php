<?php

namespace App\Repositories;

use App\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostRepository implements PostRepositoryInterface
{
    protected $model;

    /**
     * PostRepository constructor.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    public function all()
    {
        $this->model->all();
    }

    public function store(array $data)
    {
      return $this->model->create($data);
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
        if (null == $post = $this->model->find($id)) {
            throw new ModelNotFoundException("Post not found");
        }

        return $post;
    }
}
