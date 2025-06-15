<?php

use App\Http\Controllers\{
    VehicleController, BookingController, ProfileController,
    AdminRequestController, DashboardController, UserDashboardController
};

Route::get('/', fn () => view('welcome'))->name('home');
Route::get('/vehicles', [VehicleController::class,'index'])->name('vehicles.index');

/* ---------- AREA UTENTE LOGGATO ---------- */
Route::middleware('auth')->group(function () {

    /* DASHBOARD (utente normale) */
    Route::get('/dashboard', UserDashboardController::class)->name('user.dashboard');
      
         

    /* PRENOTAZIONE + PAGAMENTO */
    Route::get('/vehicles/{vehicle}/book', [BookingController::class,'create'])
         ->name('vehicles.book');
    Route::post('/vehicles/{vehicle}/book', [BookingController::class,'store'])
         ->name('vehicles.book.store');
    Route::patch('/bookings/{booking}/pay', [BookingController::class,'pay'])
         ->name('bookings.pay');


    /* ─────── CRUD prenotazioni (utente o admin) ─────── */
    Route::get   ('/bookings/{booking}/edit',  [BookingController::class,'edit'   ])->name('bookings.edit');
    Route::patch ('/bookings/{booking}',       [BookingController::class,'update' ])->name('bookings.update');
    Route::delete('/bookings/{booking}',       [BookingController::class,'destroy'])->name('bookings.destroy');

    /* PROFILO */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/edit',   [ProfileController::class,'edit'])->name('edit');
        Route::patch('/update',[ProfileController::class,'update'])->name('update');
        Route::delete('/destroy',[ProfileController::class,'destroy'])->name('destroy');
    });

    /* RICHIESTA REVISORE */
    Route::get ('/richiesta-revisore', [AdminRequestController::class,'requestForm'])->name('reviewer.request');
    Route::post('/richiesta-revisore', [AdminRequestController::class,'sendRequest' ])->name('reviewer.send');
});

/* ---------- AREA REVISORE/ADMIN ---------- */
Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/panel', [AdminRequestController::class,'panel'])->name('panel');
    Route::resource('vehicles', VehicleController::class)->except('show');
});

/* LINK FIRMATI (approva/rigetta richieste) */
Route::middleware('signed')->name('admin.')->group(function () {
    Route::match(['get','post'],'/admin/approve/{user}',[AdminRequestController::class,'approve'])->name('approve');
    Route::match(['get','post'],'/admin/reject/{user}', [AdminRequestController::class,'reject' ])->name('reject');
});

/* Auth scaffolding Breeze */
require __DIR__.'/auth.php';
