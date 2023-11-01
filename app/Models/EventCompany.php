<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCompany extends Model
{
    use HasFactory;

    protected $table = "event_companies";

    protected $primaryKey = "event_company_id";

    protected $guarded = ["event_company_id"];
}
