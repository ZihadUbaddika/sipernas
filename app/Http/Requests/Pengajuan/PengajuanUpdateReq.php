<?php

namespace App\Http\Requests\Pengajuan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class PengajuanUpdateReq extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pengajuan_edit');
    }

    public function rules()
    {
        return [
            'nama_kegiatan'     => [
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
