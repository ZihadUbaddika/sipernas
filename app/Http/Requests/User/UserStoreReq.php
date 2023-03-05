<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UserStoreReq extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'kepegawaian_id'     => [
                'required',
            ],
            'email'    => [
                'required',
                'unique:users,email'
            ],
            'password' => [
                'required',
            ],
            'roles.*'  => [
                'integer',
            ],
            'roles'    => [
                'required',
                'array',
            ],
        ];
    }
    public function messages()
    {
        return [
            'name.required'       => 'Silahkan isi Nama anda!',
            'email.required'      => 'Silahkan isikan email yang valid!',
            'email.unique'        => 'Email sudah terdaftar!',
            'password.required'   => 'Silahkan isikan password yang valid!',
            'roles.required'      => 'Silahkan pilih role user!',
        ];
    }
}
