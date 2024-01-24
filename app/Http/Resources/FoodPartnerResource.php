<?php

namespace App\Http\Resources;

use App\Models\FoodPartner;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodPartnerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'food_partner_id' => $this->food_partner_id,
            'company_name' => $this->company_name,
            'description' => $this->description,
            'address' => $this->address,
            'contact_name' => $this->contact_name,
            'contact_email' => $this->contact_email,
            'contact_phone_number' => $this->contact_phone_number,
            'logo' => getFileUrl($this->logo, FoodPartner::IMG_DIR),
            'ratings' => $this->ratings,
        ];
    }
}
