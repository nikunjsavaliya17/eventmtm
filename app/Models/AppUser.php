<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class AppUser extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = "app_users";

    const IMG_DIR = 'app_user';

    protected $primaryKey = "app_user_id";

    protected $guarded = ["app_user_id"];

    public function getImageAttribute($value): string|\Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Contracts\Foundation\Application|null
    {
        return isset($value) ? getFileUrl($value, self::IMG_DIR) : null;
    }
}
