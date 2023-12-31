<?php

namespace App\Http\Requests\autentikasi;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidatorLogin extends FormRequest
{
    public function rules()
    {
        return [
            "password" => "required|min:8|max:15",
            "nomor_hp" => "required|digits_between:12,15"
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "success" => false,
            "message" => "Maaf, Terjadi Kesalahan Dalam Permintaan Request",
            "data" => $validator->errors()
        ]));
    }
}
