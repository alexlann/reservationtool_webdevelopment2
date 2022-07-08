<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [Controller::class, "redirect"]);

Route::get('/home', function () {
    return view('home');
})->name('home');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::post('/contact', [ClientController::class, "contact"])
    ->name('clients.contact');

// ClientController
Route::get('/clients', [ClientController::class, "index"])
    ->middleware(['auth'])->name('clients.index');
Route::get('/clients/create/{client_id?}', [ClientController::class, "create"])
    ->middleware(['auth'])->name('clients.create');
Route::post('/clients/create', [ClientController::class, "store"])
    ->middleware(['auth'])->name('clients.store');
Route::put('/clients/create/{client_id}', [ClientController::class, "update"])
    ->middleware(['auth'])->name('clients.update');
Route::delete('/clients/{client_id}', [ClientController::class, "destroy"])
    ->name('clients.delete');

// ReservationController
Route::get('/reservations', [ReservationController::class, "index"])
    ->middleware(['auth'])->name('reservations.index');
Route::get('/reservations/create/{client_id}/{reservation_id?}', [ReservationController::class, "create"])
    ->middleware(['auth'])->name('reservations.create');
Route::post('/reservations/create', [ReservationController::class, "store"])
    ->middleware(['auth'])->name('reservations.store');
Route::put('/reservations/create/{reservation_id}', [ReservationController::class, "update"])
    ->middleware(['auth'])->name('reservations.update');
Route::delete('/reservations/{reservation_id}', [ReservationController::class, "destroy"])
    ->name('reservations.delete');



require __DIR__.'/auth.php';
