<?php

namespace App\Http\Requests;

use App\Exceptions\APIException;
use Illuminate\Foundation\Http\FormRequest;

class AddPositionRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        $order = $this->route('order');
        if (!$order->workShift->active) {
            throw new APIException(403, 'You cannot change the order status of a closed shift!');
        }
        if ($this->user()->id !== $order->user->id) {
            throw new APIException(403, 'Forbidden! You did not accept this order!');
        }
        if (!collect(['taken', 'preparing'])->contains($order->status->code)) {
            throw new APIException(403, 'Forbidden! Cannot be added to an order with this status');
        }
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
            'menu_id' => 'required|exists:menus,id',
            'count' => 'required|integer|between:1,10'
        ];
    }

    public function messages()
    {
        $messages = parent::messages();
        $messages += [
            'menu_id.exists' => 'Item is not in the menu',
            'count.between' => 'The number of portions should be form 1 to 10'
        ];
        return $messages;
    }
}
