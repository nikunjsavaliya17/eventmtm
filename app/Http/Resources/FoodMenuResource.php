<?php

namespace App\Http\Resources;

use App\Models\FoodMenu;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodMenuResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'food_menu_id' => $this->food_menu_id,
            'title' => $this->title,
            'description' => $this->description,
            'amount' => $this->amount,
            'sku' => $this->sku,
            'ingredients' => $this->ingredients,
            'other_details' => $this->other_details,
            'image' => getFileUrl($this->image, FoodMenu::IMG_DIR),
            'ratings' => $this->ratings,
            'food_partner' => new FoodPartnerResource($this->whenLoaded('foodPartnerDetail')),
            'food_type' => new FoodTypeResource($this->whenLoaded('typeDetail')),
        ];
    }
}
