<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        // dd($request);
        if (Auth::check()) {
            $validate_data = $request->validate([
                'user_id' => 'required',
                'quantity' => 'required',
                'food_id' => 'required',
            ]);

            // Check if the combination of user_id and food_id already exists in the cart
            $existingCartItem = Cart::where('user_id', $validate_data['user_id'])
                ->where('food_id', $validate_data['food_id'])
                ->first();

            if ($existingCartItem) {
                // If the combination exists, update the quantity
                $existingCartItem->quantity += $validate_data['quantity'];
                $existingCartItem->save();
            } else {
                // If the combination doesn't exist, create a new record
                $newCartItem = new Cart;
                $newCartItem->user_id = $validate_data['user_id'];
                $newCartItem->quantity = $validate_data['quantity'];
                $newCartItem->food_id = $validate_data['food_id'];
                $newCartItem->save();
            }

            // Redirect to the menu with a success message
            return redirect('menu')->with('success', 'Your order has been added to the cart');
        } else {
            // User is not logged in, redirect to the login page
            return redirect('login')->with('error', 'Please log in to add items to the cart');
        }
    }
    public function destory($id)
    {
        $Cart = new Cart;
        $Cart = $Cart->where('id', $id)->First();
        $Cart->delete();
        return redirect('admin/cart')->with('success', 'Your data have been deleted');
    }
}
