<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileImageStorage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required',
            'profile_image'     =>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.required'             => 'El campo nombre es requerido',
            'profile_image.required'    => 'El campo imagen es requerido',
            'profile_image.image'       => 'El archivo debe contener una imagen valida',
            'profile_image.mimes'       => 'El campo solo acepta formatos tipo imagen',
            'profile_image.max'         => 'El archivo es demasiado grande'
        ];
    }
}
