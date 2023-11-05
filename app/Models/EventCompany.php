<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventCompany extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "event_companies";

    protected $primaryKey = "event_company_id";

    protected $guarded = ["event_company_id"];
}
