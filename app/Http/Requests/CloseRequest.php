<?php

namespace App\Http\Requests;

use App\Exceptions\APIException;
use App\Http\Requests\APIRequest;
use App\Models\WorkShift;

class CloseRequest extends APIRequest
{

    public function authorize()
    {
        return WorkShift::where(['active' => true])->first();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
        ];
    }

    protected function failedAuthorization()
    {
        throw new APIException(403, 'Forbidden. The shift is already closed');
    }
}
