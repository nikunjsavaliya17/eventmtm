<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventMedia extends Model
{
    use HasFactory;

    const MEDIA_DIR = 'event-media';

    protected $table = "event_media";

    protected $primaryKey = "event_media_id";

    protected $guarded = ["event_media_id"];
}
