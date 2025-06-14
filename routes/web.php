<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminRequestController;
use Illuminate\Support\Facades\Auth;

//  HOME e catalogo veicoli pubblico
Route::get('/', fn () => view('welcome'))->name('home');
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');

//  AUTENTICATO
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', fn () => view('dashboard'))->middleware('verified')->name('dashboard');

    // Prenotazioni
    Route::get('/vehicles/{vehicle}/book', [BookingController::class, 'create'])->name('vehicles.book');
    Route::post('/vehicles/{vehicle}/book', [BookingController::class, 'store'])->name('vehicles.book.store');
    Route::post('/bookings/check', [BookingController::class, 'check'])->name('bookings.check');

    // Profilo utente
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/update', [ProfileController::class, 'update'])->name('update');
        Route::delete('/destroy', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Richiesta revisore (non admin)
    Route::get('/richiesta-revisore', [AdminRequestController::class, 'requestForm'])->name('reviewer.request');
    Route::post('/richiesta-revisore', [AdminRequestController::class, 'sendRequest'])->name('reviewer.send');
});


//  REVISORE / ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Pannello revisore
    Route::get('/panel', [AdminRequestController::class, 'panel'])->name('panel');

    // CRUD veicoli - crea tutte le rotte: admin.vehicles.index, create, store, edit, update, destroy
    Route::resource('vehicles', VehicleController::class)->except(['show']);
});


//  LINK FIRMATI (approvazione / rifiuto)
Route::middleware(['signed'])->name('admin.')->group(function () {
    Route::match(['get', 'post'], '/admin/approve/{user}', [AdminRequestController::class, 'approve'])->name('approve');
    Route::match(['get', 'post'], '/admin/reject/{user}', [AdminRequestController::class, 'reject'])->name('reject');
});

//  AUTENTICAZIONE


require __DIR__.'/auth.php';

