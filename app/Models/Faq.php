<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "faqs";

    protected $primaryKey = "faq_id";

    protected $guarded = ["faq_id"];

    public function scopeByActive($q)
    {
        $q->where('is_active', 1);
    }
}
