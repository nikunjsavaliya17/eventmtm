<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodPartner extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "food_partners";

    const IMG_DIR = 'food_partner';

    protected $primaryKey = "food_partner_id";

    protected $guarded = ["food_partner_id"];

    public function createdByUser(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'user_id', 'created_by');
    }

    public function scopeByActive($q)
    {
        $q->where('is_active', 1);
    }

    public function relatedEvents(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FoodPartnerEvent::class, 'food_partner_id', 'food_partner_id');
    }
}
