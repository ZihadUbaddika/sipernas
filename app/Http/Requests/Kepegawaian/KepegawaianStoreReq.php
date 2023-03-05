<?php

namespace App\Http\Requests\Kepegawaian;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class KepegawaianStoreReq extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kepegawaian_create');
    }

    public function rules()
    {
        return [
            'email'    => [
                'required',
            ],
            'foto'    => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
            ],
        ];
    }
    public function messages()
    {
        return [
            'name.required'       => 'Silahkan isi Nama anda!',
            'email.required'      => 'Silahkan isikan email yang valid!',
            'photo.required'      => 'Silahkan upload foto anda!',
            'photo.image'         => 'Silahkan upload file berupa gambar!',
            'photo.mimes'         => 'Gunakan ekstensi .jpeg, .png, .jpg, .gif, atau .svg!',
            'photo.max'           => 'Ukuran foto maksimal 2MB!',
            'password.required'   => 'Silahkan isikan password yang valid!',
            'roles.required'      => 'Silahkan pilih role user!',
        ];
    }
}
