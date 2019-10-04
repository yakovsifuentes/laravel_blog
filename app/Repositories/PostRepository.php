<?php

namespace App\Repositories;

use App\Post;
use App\PostTO;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\UserTO;

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

    public function store(PostTO $post)
    {
        $this->model->create([
            'user_id'  => Auth::id(),
            'comment'  => $post->getComment(),
            'media_id' => $post->getImage()
            ]);
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


    public function allPostbyUser(UserTO $userTO)
    {
        return Post::where('user_id', $userTO->getId())->get();
    }
}
