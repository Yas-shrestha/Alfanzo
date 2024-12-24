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
        $fileLocation = public_path('pdf/Alfanzoo-resort.pdf');
        return view('resturant.qr-scan.php');
    }
}
