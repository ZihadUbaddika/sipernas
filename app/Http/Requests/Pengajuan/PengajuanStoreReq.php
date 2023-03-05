<?php

namespace App\Http\Requests\Pengajuan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class PengajuanStoreReq extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pengajuan_create');
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
        ];
    }
}
