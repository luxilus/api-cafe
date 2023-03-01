<?php

namespace App\Http\Requests;

use App\Exceptions\APIException;
use App\Models\WorkShift;
use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        $workShift = WorkShift::find($this->work_shift_id);

        if (!$workShift->active) {
            throw new APIException(403, 'Forbidden. The shift must be active!');
        }
        if (!$workShift->hasUser($this->user())) {
            throw new APIException(403, 'Forbidden. You don\'t work this shift!');
        }
        return true;
    }


    public function rules()
    {
        return [
            'work_shift_id' => 'required|exists:work_shifts,id',
            'table_id' => 'required|exists:tables,id',
            'number_of_person' => 'integer'
        ];
    }
}
