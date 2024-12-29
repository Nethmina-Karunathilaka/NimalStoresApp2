<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MobileverifyController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderControlller;
use App\Http\Controllers\ProductSearchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Models\Product;


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

Route::get('/', function () {

    // Fetch featured products
    $featuredProducts = Product::where('featured', true)->get();

    // Pass featured products to the view
    return view('welcome', compact('featuredProducts'));


})->name('welcome');

Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/welcomeabout', [AboutController::class, 'welcomeabout'])->name('welcomeabout');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
});



Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('admin', AdminController::class);
    // Add more admin routes as needed
});



Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});


Route::get('/products', [UserController::class, 'showProducts'])->name('products');
Route::get('/welcomeproducts', [UserController::class, 'welcomeProducts'])->name('welcomeproducts');




Route::middleware(['auth'])->group(function () {
    // Show the email verification notice (if not verified)
    Route::get('email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    // Handle the email verification link
    Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->name('verification.verify');

    // Resend verification link
    Route::post('email/verification-notification', [VerificationController::class, 'resend'])
        ->name('verification.resend');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        // Fetch featured products
        $featuredProducts = Product::where('featured', true)->get();
        return view('dashboard', compact('featuredProducts'));
    })->name('dashboard'); // Added route name
});



// Checkout route (form submission)
Route::post('/checkout', [OrderControlller::class, 'store'])->middleware('auth')->name('orders.checkout');

// View user's orders
Route::get('/orders', [OrderControlller::class, 'index'])->middleware('auth')->name('orders.index');

// Admin: View all orders
Route::get('/admin/orders', [OrderControlller::class, 'adminIndex'])->middleware('is_admin')->name('admin.orders.index');

// Admin: Update order status
Route::patch('/admin/orders/{order}/status', [OrderControlller::class, 'updateStatus'])->middleware('is_admin')->name('admin.orders.updateStatus');


Route::get('/search', [ProductSearchController::class, 'search'])->name('search');
Route::get('/autosuggest', [ProductSearchController::class, 'autosuggest'])->name('autosuggest');


Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users.index')->middleware('auth', 'is_admin');


require __DIR__.'/auth.php';
