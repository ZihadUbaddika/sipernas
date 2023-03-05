<?php

namespace App\Http\Requests\Kepegawaian;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class KepegawaianUpdateReq extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kepegawaian_edit');
    }

    public function rules()
    {
        return [
            'email'    => [
                'required',
            ],
        ];
    }
    public function messages()
    {
        return [
            'name.required'       => 'Silahkan isi Nama anda!',
            'email.required'      => 'Silahkan isikan email yang valid!',
            'photo.required'      => 'Silahkan upload foto anda!',
            'password.required'   => 'Silahkan isikan password yang valid!',
            'roles.required'      => 'Silahkan pilih role user!',
        ];
    }
}
