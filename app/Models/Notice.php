<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_id',
        'title',
        'sub-title',
        'description',
    ];
    public function files()
    {
        return $this->belongsTo(Files::class, "file_id");
    }
}
