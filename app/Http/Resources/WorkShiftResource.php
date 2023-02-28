<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkShiftResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'data';
    public function toArray(Request $request)
    {
//        return parent::toArray($request);
        return [
//            'data' => [
                'id' => $this->id,
                'start' => $this->start,
                'end' => $this->end,
//            ]
        ];
    }
}
