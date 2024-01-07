<?php

use App\Http\Controllers\ChargeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\LaravelTravelController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationSlotController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/reservation_system/top', function () {
    return view('/reservation_system/top');
})->middleware(['auth', 'verified'])->name('reservation_system.top');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// 問い合わせ
Route::resource('/reservation_system/inquiry', InquiryController::class);
Route::post('/reservation_system/inquiry', [InquiryController::class, 'index']);

// 予約枠管理
Route::resource('/reservation_system/reservation_slot', ReservationSlotController::class)->only('index', 'create', 'store', 'show', 'update');
Route::get('/reservation_slot/destroy/{reservation_system}', [ReservationSlotController::class, 'destroy'])->name('reservation_slot.destroy');
Route::get('/events', [ReservationSlotController::class, 'calendar']);
Route::post('/reservation_system/reservation_slot/create', [ReservationSlotController::class, 'getAvailability'])->name('reservation_slot.getAvailability');

//　宿泊プラン管理
Route::resource('/reservation_system/plan', PlanController::class);

// 予約管理
Route::resource('/reservation_system/reservation', ReservationController::class);

Route::resource('/reservation_system/charge', ChargeController::class)->only('index', 'create', 'store', 'edit', 'destroy');
Route::patch('/reservation_system/charge/updateBulk', [ChargeController::class, 'updateBulk'])->name('charge.updateBulk');
Route::get('/events/charge', [ChargeController::class, 'chargeCalendar']);



Route::get('/hotel_laravel/top', [LaravelTravelController::class, 'top'])->name('hotel_laravel.top');
Route::get('/hotel_laravel/rooms', [LaravelTravelController::class, 'rooms'])->name('hotel_laravel.rooms');
Route::get('/hotel_laravel/plans', [LaravelTravelController::class, 'plans'])->name('hotel_laravel.plans');
Route::get('/hotel_laravel/room_calender/{plan}', [LaravelTravelController::class, 'room_calender'])->name('hotel_laravel.room_calender');
Route::get('/events/room_calender/{plan}', [LaravelTravelController::class, 'calender'])->name('events.room_calender');
Route::get('/hotel_laravel/reservation_create', [LaravelTravelController::class, 'reservation_create'])->name('hotel_laravel.reservation_create');
Route::get('/events/reservation_calender/{plan}', [LaravelTravelController::class, 'calender'])->name('events.reservation_calender');
Route::get('/hotel_laravel/inquiries', [LaravelTravelController::class, 'inquiries'])->name('hotel_laravel.inquiries');
Route::post('/hotel_laravel/inquiries', [LaravelTravelController::class, 'inquiries_complete'])->name('inquiries_complete');
Route::get('/hotel_laravel/access', [LaravelTravelController::class, 'access'])->name('hotel_laravel.access');
Route::post('/get-matching-data', [LaravelTravelController::class, 'getMatchingData']);
Route::post('/hotel_laravel/reservation_complete', [LaravelTravelController::class, 'reservation_complete'])->name('hotel_laravel.reservation_complete');