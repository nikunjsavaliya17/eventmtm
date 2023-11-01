<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $table = "sponsors";

    protected $primaryKey = "sponsor_id";

    protected $guarded = ["sponsor_id"];
}
