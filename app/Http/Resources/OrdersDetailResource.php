<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersDetailResource extends OrderResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $collection = parent::toArray($request);
        unset($collection['price']);
        $collection['positions'] = PositionResource::collection($this->position);
        $collection['price_all'] = $this->getPrice();
        return $collection;
    }
}
