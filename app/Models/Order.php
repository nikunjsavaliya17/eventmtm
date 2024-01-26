<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;

    const IMG_DIR = 'orders';
    const STATUSES = [
        0 => 'Pending',
        1 => 'Successful',
        2 => 'Cancelled',
        3 => 'Failed',
    ];

    protected $table = "orders";

    protected $primaryKey = "order_id";

    protected $guarded = ["order_id"];

    protected $casts = ["payment_details" => 'array'];

    public function orderItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id')->with(['foodMenuDetail']);
    }

    public function eventDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Event::class, 'event_id', 'event_id')->withTrashed();
    }

    public function appUserDetail(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(AppUser::class, 'app_user_id', 'app_user_id');
    }
}
