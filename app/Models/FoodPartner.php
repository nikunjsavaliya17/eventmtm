<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodPartner extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "food_partners";

    protected $primaryKey = "food_partner_id";

    protected $guarded = ["food_partner_id"];
}
