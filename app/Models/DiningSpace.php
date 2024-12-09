<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiningSpace extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'file_id', 'nooftables', 'description'];
    public function files()
    {
        return $this->belongsTo(Files::class, "file_id");
    }
    public function tables()
    {
        return $this->hasMany(Table::class, "space_id", "id");
    }
}
