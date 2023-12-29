<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    const IDENTIFIERS = [
        'reset_password' => 'Reset Account Password Mail',
    ];

    protected $table = 'email_templates';

    protected $fillable = ['identifier', 'subject', 'content'];
}
