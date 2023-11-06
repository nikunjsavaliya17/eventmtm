<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodMenu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "food_menu";

    protected $primaryKey = "food_menu_id";

    protected $guarded = ["food_menu_id"];

    public function typeDetail()
    {
        return $this->hasOne(FoodType::class, 'food_type_id', 'food_type_id')->withTrashed();
    }
}
