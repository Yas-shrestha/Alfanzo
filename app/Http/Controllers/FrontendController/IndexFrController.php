<?php

namespace App\Http\Controllers\FrontendController;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AboutFeature;
use App\Models\Carousel;
use App\Models\Cart;
use App\Models\Food;
use App\Models\Order;
use App\Models\reservation;
use App\Models\SiteConfig;
use App\Models\Team;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class IndexFrController extends Controller
{
    public function index()
    {
        $foods = Food::limit(4)->get();
        $user_id = auth()->check() ? auth()->user()->id : null;
        $carousels = Carousel::all();
        $about = About::query()->firstOrCreate([
            'file_id' => '1',
            'title' => 'Resturant bagaicha',
            'description' => 'Welcome to our resturant Bagaicha where You will feel at home'
        ]);
        $aboutFeature = AboutFeature::limit(4)->get();
        $teams = Team::limit(4)->get();
        $testimonials = Testimonial::all();
        $settings = SiteConfig::all();
        return view('resturant.index', compact('carousels', 'about', 'aboutFeature', 'foods', 'teams', 'testimonials', 'user_id', 'settings'));
    }
    public function about()
    {
        $about = About::query()->first();
        $aboutFeature = AboutFeature::limit(4)->get();
        $teams = Team::limit(4)->get();
        $settings = SiteConfig::all();
        return view('resturant.about', compact('about', 'aboutFeature', 'teams', 'settings'));
    }
    public function bookedTable()
    {
        $id = Auth()->id();
        $reservations = reservation::where('user_id', $id)->get();
        $settings = SiteConfig::all();
        return view('resturant.booked-table', compact('reservations', 'settings'));
    }

    public function cart()
    {
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $cart = Cart::where('user_id', $user_id);
            $cart = $cart->with('food')->get();
            $settings = SiteConfig::all();
            return view('resturant.cart', compact('cart', 'settings'));
        } else {
            return redirect('/login')->with('error', 'Please log in first to Order');
        }
    }
    public function contact()
    {
        $settings = SiteConfig::all();
        return view('resturant.contact', compact('settings'));
    }
    public function menu()
    {
        $foodsQr = Food::all();
        $user_id = auth()->check() ? auth()->user()->id : null;
        $breakfast = Food::where('type', 'breakfast')->get();
        $lunch = Food::where('type', 'lunch')->get();
        $dinner = Food::where('type', 'dinner')->get();
        $drinks = Food::where('type', 'drinks')->get();
        $desert = Food::where('type', 'desert')->get();
        $teams = Team::limit(4)->get();
        $settings = SiteConfig::all();
        return view('resturant.menu', compact('desert', 'user_id', 'breakfast', 'lunch', 'dinner', 'drinks', 'foodsQr', 'teams', 'settings'));
    }
    public function notFound()
    {
        $settings = SiteConfig::all();
        return view('resturant.404', compact('settings'));
    }
    public function order()
    {
        $id = Auth()->id();
        $orders = Order::where('user_id', $id)->get();
        $settings = SiteConfig::all();
        return view('resturant.orders', compact('orders', 'settings'));
    }
    public function team()
    {
        $teams = Team::all();
        $settings = SiteConfig::all();
        return view('resturant.team', compact('teams', 'settings'));
    }
    public function testimonial()
    {
        $testimonials = Testimonial::all();
        $settings = SiteConfig::all();
        return view('resturant.testimonial', compact('testimonials', 'settings'));
    }
}
