<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gallery extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'file_id', 'description'];
    public function files()
    {
        return $this->belongsTo(Files::class, "file_id", 'id');
    }
}
