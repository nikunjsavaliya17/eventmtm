<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'order_id' => $this->order_id,
            'order_no' => $this->order_no,
            'amount' => formatAmount($this->amount),
            'status' => Order::STATUSES[$this->status],
            'created_at' => formatDate($this->created_at),
            'qr_image' => getFileUrl($this->qr_image, Order::IMG_DIR),
            'notes' => $this->notes,
            'payment_details' => $this->payment_details,
            'event_detail' => new EventResource($this->whenLoaded('eventDetail')),
            'user_detail' => new AppUserResource($this->whenLoaded('appUserDetail')),
            'order_items' => OrderItemResource::collection($this->whenLoaded('orderItems')),
        ];
    }
}
