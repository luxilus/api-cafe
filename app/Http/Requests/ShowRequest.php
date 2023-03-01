<?php

namespace App\Http\Requests;

use App\Exceptions\APIException;
use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        $order = $this->route('order');
        return $order->user->id === $this->user()->id;
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
    protected function failedAuthorization()
    {
        throw new APIException(403, 'Forbidden. You did not accept this order!');
    }
}
