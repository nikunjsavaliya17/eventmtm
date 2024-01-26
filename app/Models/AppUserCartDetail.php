<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppUserCartDetail extends Model
{
    protected $table = "app_user_cart_details";

    protected $primaryKey = "app_user_cart_detail_id";

    protected $guarded = ["app_user_cart_detail_id"];

    public function foodMenuDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(FoodMenu::class, 'food_menu_id', 'food_menu_id');
    }
}
