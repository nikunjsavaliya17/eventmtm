<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodMenu extends Model
{
    use HasFactory;

    protected $table = "food_menu";

    protected $primaryKey = "food_menu_id";

    protected $guarded = ["food_menu_id"];
}
