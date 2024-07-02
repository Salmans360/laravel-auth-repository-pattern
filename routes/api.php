<?php

use App\Http\Controllers\API\AppointmentController;
use App\Http\Controllers\API\CouponController;
use App\Http\Controllers\API\DataController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/api/data', [DataController::class, 'index'])->name('api.data');

// Add a route for the search method
Route::get('user/search', [UserController::class, 'search'])->name('user.search');
Route::apiResource('user', UserController::class);

/****** Location Route *********/
Route::get('/location/within-radius', [LocationController::class, 'getLocationsWithinRadius'])->name('location.within_radius');
Route::apiResource('location', LocationController::class);

/****** Coupon Route *********/
Route::get('coupons/by-location/{id}', [CouponController::class, 'getCouponsByLocations'])->name('coupons.by-location');
Route::apiResource('coupon', CouponController::class);

/****** Appointment Route *********/
Route::resource('appointments', AppointmentController::class);

