<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodPartner extends Model
{
    use HasFactory;

    protected $table = "food_partners";

    protected $primaryKey = "food_partner_id";

    protected $guarded = ["food_partner_id"];
}
