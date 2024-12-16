<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    use HasFactory;
    protected $fillable = ['title'];
    public function food()
    {
        $this->hasMany(Food::class, 'category_id', 'id');
    }
}
