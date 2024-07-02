<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeController1;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});
//

Auth::routes();

Route::get('/', [DealerController::class, 'index'])->name('home');
/****** Dealer Custom Route *********/
Route::get('/dealer/search', [DealerController::class, 'search']);
Route::get('dealer/export', [DealerController::class, 'exportToCSV']);
Route::resource('dealer', DealerController::class);


/****** Coupon Custom Route *********/
Route::get('/coupon/search', [CouponController::class, 'search']);
Route::get('coupon/export', [CouponController::class, 'exportToCSV']);
Route::resource('coupon', CouponController::class);


/****** Content Custom Route *********/
Route::get('/appointment/search', [AppointmentController::class, 'search']);
Route::get('appointment/export', [AppointmentController::class, 'exportToCSV']);
Route::resource('appointment', AppointmentController::class);
