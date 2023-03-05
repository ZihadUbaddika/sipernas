<?php

namespace App\Http\Requests\Spt;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class SptUpdateReq extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pengajuan_edit');
    }

    public function rules()
    {
        return [
            'no_spt'     => [
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
