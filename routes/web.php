<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DiningSpaceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EsewaPaymentController;
use App\Http\Controllers\FrontendController\AboutFrController;
use App\Http\Controllers\FrontendController\BookedTableController;
use App\Http\Controllers\FrontendController\BookingFrController;
use App\Http\Controllers\FrontendController\CartFrController;
use App\Http\Controllers\FrontendController\ContactFrController;
use App\Http\Controllers\FrontendController\IndexFrController;
use App\Http\Controllers\FrontendController\MenuFrController;
use App\Http\Controllers\FrontendController\NotFoundController;
use App\Http\Controllers\FrontendController\OrderController;
use App\Http\Controllers\FrontendController\PickupController;
use App\Http\Controllers\FrontendController\ReservationsController;
use App\Http\Controllers\FrontendController\TeamFrController;
use App\Http\Controllers\FrontendController\TestimonialFrController;
use App\Http\Controllers\FrontendController\UserFrController;
use App\Http\Controllers\PaymentFailedController;
use App\Http\Controllers\PaymentSuccessController;
use App\Http\Controllers\PickupController as ControllersPickupController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use App\Models\DiningSpace;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [IndexFrController::class, 'index'])->name('/');
Route::get('/team', [IndexFrController::class, 'team'])->name('team');
Route::get('/testimonial', [IndexFrController::class, 'testimonial'])->name('testimonial');
Route::get('/contact', [IndexFrController::class, 'contact'])->name('contact');
Route::get('/about', [IndexFrController::class, 'about'])->name('about');
Route::get('/cart', [IndexFrController::class, 'cart'])->name('cart');
Route::get('/menu', [IndexFrController::class, 'menu'])->name('menu');
Route::get('/booked-table', [IndexFrController::class, 'bookedTable'])->name('booked-table');
Route::get('/order', [IndexFrController::class, 'order'])->name('order');
Route::get('/404', [IndexFrController::class, 'notfound'])->name('404');
Route::get('/room', [IndexFrController::class, 'room'])->name('room');
Route::get('/tables', [IndexFrController::class, 'tables'])->name('table');
Route::get('/spaces', [IndexFrController::class, 'spaces'])->name('spaces');
// pickup
Route::post('/pickinUp', [PickupController::class, 'store'])->name('pickup.store');
Route::get('/pickup/confirm/{id}/{action}/{token}', [PickupController::class, 'confirm'])->name('pickup.confirm');
// pickup

Route::get('/qr-page', QRCodeController::class)->name('qr-page');
Route::get('/payment-failed', PaymentFailedController::class)->name('payment-failed');
Route::get('/user-password', [UserFrController::class, 'passwordChange'])->name('change.password');
Route::get('/user-info', [UserFrController::class, 'index'])->name('user-info');
Route::post('/user/update/{id}', [UserFrController::class, 'update'])->name('userfr.update');
Route::post('/carts', [CartController::class, 'index'])->name('cart.store');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/booking', [BookingFrController::class, 'index'])->name('booking');
Route::post('/booking/book', [BookingFrController::class, 'book'])->name('booking.book');
Route::get('/booking/confirm/{id}/{action}/{token}', [BookingFrController::class, 'confirm'])->name('booking.confirm');

Route::get('/booking/bookin', function () {
    // Redirect to a 404 page or handle it as needed
    return redirect('404');
});

Route::post('esewa/pay', [EsewaPaymentController::class, 'pay'])->name('esewa.pay');
Route::get('esewa/check', [EsewaPaymentController::class, 'check'])->name('esewa.check');
Route::get('reservation/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservation.cancel');

Route::resource('/newsletter', 'App\Http\Controllers\NewsletterController');
Route::prefix('/admin')->group(function () {
    Route::resource('/reservation', 'App\Http\Controllers\ReservationController');
    Route::resource('/contacts', 'App\Http\Controllers\ContactController');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'checkRole'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/update-reservation/{id}', [ReservationController::class, 'updateStatus'])->name('update.reservation');
    Route::get('/pickup', [ControllersPickupController::class, 'index'])->name('pickups.index');
    Route::get('/pickup/create', [ControllersPickupController::class, 'create'])->name('pickups.create');
    Route::delete('/pickup/{id}', [ControllersPickupController::class, 'destroy'])->name('pickups.destroy');
    Route::get('/pickup/show/{id}', [ControllersPickupController::class, 'show'])->name('pickups.show');
    Route::get('/pickup/cancel/{id}', [ControllersPickupController::class, 'cancel'])->name('pickups.cancel');
    Route::post('/update-pickup/{id}', [ControllersPickupController::class, 'updateStatus'])->name('update.pickup');



    Route::prefix('/admin')->group(function () {
        Route::resource('/', 'App\Http\Controllers\DashboardController');
        Route::resource('/fileManager', 'App\Http\Controllers\FileController');
        Route::resource('/carousels', 'App\Http\Controllers\carouselController');
        Route::resource('/foods', 'App\Http\Controllers\FoodController');
        Route::resource('/abouts', 'App\Http\Controllers\AboutController');
        Route::resource('/about_features', 'App\Http\Controllers\AboutFeatureControlwler');
        Route::resource('/admins', 'App\Http\Controllers\AdminController');
        Route::resource('/users', 'App\Http\Controllers\UserController');
        Route::resource('/staffs', 'App\Http\Controllers\StaffController');
        Route::resource('/testimonials', 'App\Http\Controllers\TestimonialController');
        Route::resource('/team_members', 'App\Http\Controllers\TeamController');
        Route::resource('/settings', 'App\Http\Controllers\SiteConfigController');
        Route::resource('/payments', 'App\Http\Controllers\PaymentController');
        Route::resource('/tables', 'App\Http\Controllers\TableController');
        Route::resource('/orders', 'App\Http\Controllers\OrderController');
        Route::resource('/spaces', DiningSpaceController::class);
        Route::resource('/rooms', RoomController::class);
    });
});

require __DIR__ . '/auth.php';
