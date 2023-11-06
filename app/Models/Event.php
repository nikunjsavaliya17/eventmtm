<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "events";

    protected $primaryKey = "event_id";

    protected $guarded = ["event_id"];

    public function eventCompanyDetail()
    {
        return $this->hasOne(EventCompany::class, 'event_company_id', 'event_company_id');
    }
}
