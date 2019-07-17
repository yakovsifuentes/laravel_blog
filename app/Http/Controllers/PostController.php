<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $repository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository =  $repository;
    }

    public function index()
    {
        return view('Post.index');
    }

    public function show($post)
    {
        $this->repository->find($post);
    }


    public function create()
    {
        return view('Post.create');
    }

    public function store(Request $request)
    {
        dd($request);
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
