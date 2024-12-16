<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\SiteConfig;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    public function __invoke()
    {
        $categories = FoodCategory::query()->get()->all();
        $foods = Food::query()->get()->all();
        $settings = SiteConfig::all();
        return view('resturant.Qr-scan', compact('categories', 'foods', 'settings'));
    }
}
