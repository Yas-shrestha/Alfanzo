<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    use HasFactory;
    protected $fillable = ['file_id', 'name', 'number', 'noofbed', 'noofwindow', 'special_feature', 'description', 'status', 'booked_by'];

    public function files()
    {
        return $this->belongsTo(Files::class, "file_id");
    }
}
