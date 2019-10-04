<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepositoryInterface;
use App\UserTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $postRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userTO = new UserTO();
        $userTO->setId(Auth::id());
        $all_post_by_user = $this->postRepository->allPostbyUser($userTO);
        return view('home', compact('all_post_by_user'));
    }
}
