<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'noofpeople',
        'spaces',
        'room',
        'date',
        'pickup',
        'reseravtion_status',
        'specialrequest'
    ];
}
