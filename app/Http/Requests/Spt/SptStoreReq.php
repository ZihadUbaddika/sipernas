<?php

namespace App\Http\Requests\Spt;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class SptStoreReq extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('spt_create');
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
            'photo.image'         => 'Silahkan upload file berupa gambar!',
            'photo.mimes'         => 'Gunakan ekstensi .jpeg, .png, .jpg, .gif, atau .svg!',
            'photo.max'           => 'Ukuran foto maksimal 2MB!',
            'password.required'   => 'Silahkan isikan password yang valid!',
            'roles.required'      => 'Silahkan pilih role user!',
        ];
    }
}
