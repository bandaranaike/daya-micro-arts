<?php

use App\Http\Controllers\ArtController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StripeProductController;
use Illuminate\Foundation\Application;

//use Illuminate\Support\Facades\Artisan;
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
//    Illuminate\Support\Facades\Artisan::call('storage:link');
    return Inertia::render('HomePage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

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
Route::get('art/{art}', [ArtController::class, 'show']);


Route::get('cart/show', [CartController::class, 'show']);

Route::get('stripe/get-price-list', [StripeProductController::class, 'saveInDatabaseAllProductsFromStripe']);

Route::any('hooks', [ArtController::class, 'getPricesFromStripe']);

Route::webhooks('webhook-url-1', 'application-one');


