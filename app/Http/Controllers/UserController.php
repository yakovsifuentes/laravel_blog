<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepositoryInterface;
use App\UserTO;
use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use App\Http\Requests\UpdateProfileImageStorage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $repository;
    private $postRepository;

    public function __construct(UserRepositoryInterface $repository, PostRepositoryInterface $postRepository)
    {
        $this->repository = $repository;
        $this->postRepository = $postRepository;
        //$this->middleware('auth');
    }

    public function index()
    {
        dd("hola");
        $userTO = new UserTO();
        $userTO->setId(Auth::id());
        $all_post_by_user = $this->postRepository->allPostbyUser($userTO);
        //return view('auth.profile', compact('all_post_by_user'));
        return view('home', compact('all_post_by_user'));
    }


    public function create(){

    }

    public function edit($id){

    }


    public function update($id, $request){

    }

    public function updateProfile(UpdateProfileImageStorage $request)
    {

        // Get current user
        $user = $this->repository->find(auth()->user()->id);
        // Set user name
        $user->name = $request->input('name');

        if ($request->has('profile_image')) {
             // Get image file
             $image = $request->file('profile_image');
             // Make a image name based on user name and current timestamp
             $name = str_slug($request->input('name')).'_'.time();
             // Define folder path
             $folder = '/uploads/images/';
             // Make a file path where image will be stored [ folder path + file name + file extension]
             $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
             // Upload image
             $this->repository->uploadOne($image, $folder, 'public', $name);
             // Set user profile image path in database to filePath
             $user->profile_image = $filePath;
         }
         // Persist user record to database
         $user->save();

         // Return user back and show a flash message
         return redirect()->back()->with(['status' => 'Profile updated successfully.']);
    }

    public function destroy($id){

    }
}
