<?php

use App\Http\Controllers\ArtController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('HomePage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::delete("categories", [CategoryController::class, "destroy"]);
Route::get("categories", [CategoryController::class, "index"]);
Route::post("categories", [CategoryController::class, "store"]);

Route::get('contact-us', [ContactController::class, 'index']);
Route::post('contact-us', [ContactController::class, 'store']);

/**
 * Art
 */
Route::get('arts', [ArtController::class, 'showAll']);
Route::get('galleries', [ArtController::class, 'getArtsForHomePage']);
Route::get('art/create', [ArtController::class, 'create'])->middleware('auth')->name('art.create-art');
Route::post('art/create', [ArtController::class, 'store'])->name('art.store-art');
Route::get('art/canceled', [ArtController::class, 'paymentCanceled']);
Route::get('art/success', [ArtController::class, 'paymentSuccess']);
Route::get('art/{art}', [ArtController::class, 'show']);


Route::get('cart/show', [CartController::class, 'show']);

Route::get('stripe/get-price-list', [StripeProductController::class, 'saveInDatabaseAllProductsFromStripe']);

Route::any('hooks', [ArtController::class, 'getPricesFromStripe']);

Route::webhooks('webhook-url-1', 'application-one');

