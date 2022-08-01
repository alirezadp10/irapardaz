<?php

namespace App\Http\Requests;

use App\Rules\NationalCode;
use Illuminate\Foundation\Http\FormRequest;

class ViewerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'national_code' => ['required', 'unique:viewers', 'digits:10', new NationalCode()],
        ];
    }
}
