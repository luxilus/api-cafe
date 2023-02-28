<?php

namespace App\Http\Requests;

use App\Exceptions\APIException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\FlareClient\Api;

class APIRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new APIException(422, "Validation Error", $validator->errors());
    }

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        return [

        ];
    }
}
