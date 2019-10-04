<?php


namespace App\Repositories;


use App\Http\Requests\UpdateProfileImageStorage;

interface  MediaRepositoryInterface
{
    public function updateProfile(UpdateProfileImageStorage $request);
}