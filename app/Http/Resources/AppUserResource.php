<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppUserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'app_user_id' => $this->app_user_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'mobile_number' => $this->mobile_number,
            'access_token' => $this->access_token,
            'address' => $this->address,
            'image' => $this->image,
        ];
    }
}
