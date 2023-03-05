<?php

namespace App\Http\Requests\Kepegawaian;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class KepegawaianMassDestroyReq extends FormRequest
{
    public function authorize()
    {
        return abort_if(Gate::denies('kepegawaian_delete'), 403, '403 Forbidden') ?? true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:users,id',
        ];
    }
}
