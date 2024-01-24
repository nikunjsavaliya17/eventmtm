<?php

namespace App\Http\Resources;

use App\Models\FoodMenu;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodTypeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'food_type_id' => $this->food_type_id,
            'title' => $this->title,
        ];
    }
}
