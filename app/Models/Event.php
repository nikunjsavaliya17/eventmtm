<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "events";

    const IMG_DIR = 'event';

    protected $primaryKey = "event_id";

    protected $guarded = ["event_id"];

    protected $casts = ['start_date' => 'datetime', 'end_date' => 'datetime'];

    public function scopeByActive($q)
    {
        $q->where('is_active', 1);
    }

    public function eventCompanyDetail()
    {
        return $this->hasOne(EventCompany::class, 'event_company_id', 'event_company_id')->withTrashed();
    }

    public function relatedMedia(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EventMedia::class, 'event_id', 'event_id');
    }

    public function sponsors(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Sponsor::class, 'event_id', 'event_id')->where('is_active', 1);
    }

    public function createdByUser(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'user_id', 'created_by');
    }
}
