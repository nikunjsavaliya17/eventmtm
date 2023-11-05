<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SponsorType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "sponsor_types";

    protected $primaryKey = "sponsor_type_id";

    protected $guarded = ["sponsor_type_id"];
}
