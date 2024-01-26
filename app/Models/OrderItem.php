<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = "order_items";

    protected $primaryKey = "order_item_id";

    protected $guarded = ["order_item_id"];

    public function foodMenuDetail()
    {
        return $this->hasOne(FoodMenu::class, 'food_menu_id', 'food_menu_id')->withTrashed();
    }
}
