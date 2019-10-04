<?php


namespace App\Repositories;

use App\Traits\UploadTrait;
use App\Repositories\MediaRepositoryInterface;
use App\Http\Requests\UpdateProfileImageStorage;


class MediaRepository implements MediaRepositoryInterface
{
    //use UploadTrait;

    /*public function updateProfile(UpdateProfileImageStorage $request)
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
    }*/

}