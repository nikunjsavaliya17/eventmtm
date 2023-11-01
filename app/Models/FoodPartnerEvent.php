<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodPartnerEvent extends Model
{
    use HasFactory;

    protected $table = "food_partner_events";

    protected $primaryKey = "food_partner_event_id";

    protected $guarded = ["food_partner_event_id"];
}
