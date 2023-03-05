<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UserUpdateReq extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
    }

    public function rules()
    {
        return [
            'kepegawaian_id'     => [
                'required',
            ],
            'email'    => [
                'required',
            ],
            'password' => [
                'required_if:change_password,true',
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
            'photo.required'      => 'Silahkan upload foto anda!',
            'password.required_if'=> 'Silahkan isikan password yang valid!',
            'roles.required'      => 'Silahkan pilih role user!',
        ];
    }
}
