<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodMenu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "food_menu";

    const IMG_DIR = 'food_menu';

    protected $primaryKey = "food_menu_id";

    protected $guarded = ["food_menu_id"];

    public function scopeByActive($q)
    {
        $q->where('is_active', 1);
    }

    public function typeDetail()
    {
        return $this->hasOne(FoodType::class, 'food_type_id', 'food_type_id')->withTrashed();
    }

    public function foodPartnerDetail()
    {
        return $this->hasOne(FoodPartner::class, 'food_partner_id', 'food_partner_id')->withTrashed();
    }

    public function createdByUser(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'user_id', 'created_by');
    }
}
