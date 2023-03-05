<?php

namespace App\Http\Requests\Spt;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class SptnMassDestroyReq extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('pengajuan_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:users,id',
        ];
    }
}
