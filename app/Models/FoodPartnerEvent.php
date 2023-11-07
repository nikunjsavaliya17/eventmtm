<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodPartnerEvent extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "food_partner_events";

    protected $primaryKey = "food_partner_event_id";

    protected $guarded = ["food_partner_event_id"];

    public function foodPartnerDetail()
    {
        return $this->hasOne(FoodPartner::class, 'food_partner_id', 'food_partner_id')->withTrashed();
    }
}
