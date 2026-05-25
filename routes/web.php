<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\SantriController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth'])->group(function () {

    // Route khusus ustadz
    Route::middleware(['role:ustadz'])->group(function () {
        Route::resource('setoran', SetoranController::class);
        Route::patch('setoran/{id}/paraf-guru', [SetoranController::class, 'parafGuru'])->name('setoran.paraf-guru');
    });

    // Route khusus ortu
    Route::middleware(['role:ortu'])->group(function () {
        Route::patch('setoran/{id}/paraf-ortu', [SetoranController::class, 'parafOrtu'])->name('setoran.paraf-ortu');
    });

    // Route khusus santri
    Route::middleware(['role:santri'])->group(function () {
        Route::get('riwayat', [SantriController::class, 'index'])->name('santri.index');
        Route::get('riwayat/{id}', [SantriController::class, 'show'])->name('santri.show');
    });

});

require __DIR__.'/settings.php';