<?php

namespace App\Http\Requests;

use App\Exceptions\APIException;
use App\Models\WorkShift;
use Illuminate\Foundation\Http\FormRequest;

class OpenRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !WorkShift::where(['active' => true])->first();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    protected function failedAuthorization()
    {
        throw new APIException(403, 'Forbidden. There are open shifts!');
    }
}
