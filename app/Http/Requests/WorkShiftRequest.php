<?php

namespace App\Http\Requests;

use App\Http\Requests\APIRequest;
use Illuminate\Foundation\Http\FormRequest;

class WorkShiftRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start' => 'required|date_format:Y-m-d H:i|after_or_equal:now',
            'end' => 'required|date_format:Y-m-d H:i|after:start',
        ];
    }
}
