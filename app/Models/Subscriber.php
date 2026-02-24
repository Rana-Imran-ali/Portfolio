<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['email', 'email_verified_at', 'verification_token', 'is_verified'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_verified'       => 'boolean',
    ];
}
