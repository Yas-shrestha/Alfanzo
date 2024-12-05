<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $fillable = [
        'table_status',
        'file_id',
        'space_id',
        'table_no',
    ];
    public function fileManager()
    {
        return $this->belongsTo(Files::class, "file_id");
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, "table_id");
    }
}
