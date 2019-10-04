<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepositoryInterface;
use App\Repositories\MediaRepositoryInterface;
use App\UserTO;
use Illuminate\Http\Request;
use App\PostTO;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(
        PostRepositoryInterface $postRepository
        )
    {
        $this->postRepository =  $postRepository;
    }

    public function index()
    {
        $userTO = new UserTO();
        $userTO->setId(Auth::id());
        $all_post_by_user = $this->postRepository->allPostbyUser($userTO);
        return view('Post.index', compact('all_post_by_user'));
    }

    public function show($post)
    {
        $this->postRepository->find($post);
    }


    public function create()
    {
        return view('Post.create');
    }

    public function store(Request $request)
    {
        $post = new PostTO();
        $post->setImage($request->photo_id);
        $post->setComment($request->comment);
        $this->postRepository->store($post);
        $userTO = new UserTO();
        $userTO->setId(Auth::id());
        $all_post_by_user = $this->postRepository->allPostbyUser($userTO);
        return view('home', compact('all_post_by_user'));
    }

    public function edit($id)
    {

    }


    public function update($id, $request)
    {

    }

    public function destroy($id)
    {

    }
}
