<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'order_item_id' => $this->order_item_id,
            'quantity' => $this->quantity,
            'amount' => formatAmount($this->amount),
            'total_amount' => formatAmount($this->total_amount),
            'food_detail' => new FoodMenuResource($this->whenLoaded('foodMenuDetail')),
        ];
    }
}
