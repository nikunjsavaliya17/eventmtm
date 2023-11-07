<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sponsor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "sponsors";

    protected $primaryKey = "sponsor_id";

    protected $guarded = ["sponsor_id"];

    public function typeDetail()
    {
        return $this->hasOne(SponsorType::class, 'sponsor_type_id', 'sponsor_type_id')->withTrashed();
    }
}
