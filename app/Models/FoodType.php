<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    use HasFactory;

    protected $table = "food_types";

    protected $primaryKey = "food_type_id";

    protected $guarded = ["food_type_id"];
}
