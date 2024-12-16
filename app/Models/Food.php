<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'file_id',
        'price',
        'category_id'
    ];

    public function cart()
    {
        return $this->hasMany(cart::class, "food_id");
    }
    public function payment()
    {
        return $this->hasMany(Payment::class, "food_id");
    }
    public function order()
    {
        return $this->hasMany(Order::class, "food_id");
    }
    public function files()
    {
        return $this->belongsTo(Files::class, "file_id");
    }
    public function foods()
    {
        return $this->belongsTo(Food::class, "food_id");
    }
    public function category()
    {
        return $this->belongsTo(FoodCategory::class, "category_id", 'id');
    }
}
