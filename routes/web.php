<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

echo("<script>console.log('PHP: **************Route*********************');</script>");
Route::get('hotel', [HotelController::class, 'index'])->name('hotel');
Route::get('/', [HotelController::class, 'index'])->name('hotel');

Route::get('/reservation/{hotel_id}', 'App\Http\Controllers\HotelController@reserve')->name('reservation')->middleware(['auth', 'verified']);
Route::post('/store/{hotel_id}', 'App\Http\Controllers\HotelController@store')->name('store');

Route::get('/room/{hotel_id}/{checkin}/{checkout}', 'App\Http\Controllers\HotelController@roomavailable')->name('roomavailable');

require __DIR__.'/auth.php';
