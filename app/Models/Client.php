<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable =['name', 'phone', 'status','reminder_at'];

    protected $casts = [
        'reminder_at' => 'datetime',
    ];
}
