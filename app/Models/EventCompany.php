<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventCompany extends Model
{
    use HasFactory, SoftDeletes;

    const IMG_DIR = 'event-company';

    protected $table = "event_companies";

    protected $primaryKey = "event_company_id";

    protected $guarded = ["event_company_id"];

    public function createdByUser(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'user_id', 'created_by');
    }
}
