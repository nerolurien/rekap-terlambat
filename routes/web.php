<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\TerlambatController;

Route::middleware(['IsLogin'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});
//Halaman Login
Route::middleware(['IsGuest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); // <- Pastikan ini ada
    Route::post('/login', [AuthController::class, 'login']);
});



Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/error', function(){
    return view('error.404');
})->name('error');

Route::middleware(['IsAdmin'])->group(function() {
    Route::prefix('/users')->name('user.')->group(function(){
        Route::get('/', [UsersController::class, 'index'])->name('manage');
        Route::get('/create', [UsersController::class, 'create'])->name('create');
        Route::post('/store', [UsersController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [UsersController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [UsersController::class, 'delete'])->name('destroy');
        Route::get('/{id}/show', [UsersController::class, 'show'])->name('show');
    });

    Route::prefix('/rombel')->name('rombel.')->group(function(){
        Route::get('/', [RombelController::class, 'index'])->name('manage');
        Route::get('/create', [RombelController::class, 'create'])->name('create');
        Route::post('/store', [RombelController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [RombelController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [RombelController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [RombelController::class, 'delete'])->name('destroy');
    });

    Route::prefix('/rayon')->name('rayon.')->group(function(){
        Route::get('/', [RayonController::class, 'index'])->name('index');
        Route::get('/create', [RayonController::class, 'create'])->name('create');
        Route::post('/store', [RayonController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [RayonController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [RayonController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [RayonController::class, 'delete'])->name('destroy');
    });

    Route::prefix('/siswa')->name('siswa.')->group(function(){
        Route::get('/', [SiswaController::class, 'index'])->name('index');
        Route::get('/create', [SiswaController::class, 'create'])->name('create');
        Route::post('/store', [SiswaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [SiswaController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [SiswaController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [SiswaController::class, 'delete'])->name('destroy');
    });

    Route::prefix('/terlambat')->name('terlambat.')->group(function(){
        Route::get('/', [TerlambatController::class, 'index'])->name('index');
        Route::get('/create', [TerlambatController::class, 'create'])->name('create');
        Route::post('/store', [TerlambatController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TerlambatController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [TerlambatController::class, 'update'])->name('update');
        Route::get('/{id}/show', [TerlambatController::class, 'show'])->name('show');
        Route::delete('/{id}/delete', [TerlambatController::class, 'delete'])->name('destroy');
        Route::get('/cetak-surat/{id}', [TerlambatController::class, 'generatePDF'])->name('cetak');
        Route::Get('/export', [TerlambatController::class, 'export'])->name('export');
    });
});

Route::middleware(['IsPS'])->group(function() {
    Route::prefix('/ps/siswa')->name('ps.siswa.')->group(function(){
        Route::get('/', [PembimbingController::class, 'index'])->name('index');
    });
    Route::prefix('/ps/terlambat')->name('ps.terlambat.')->group(function(){
        Route::get('/', [PembimbingController::class, 'indexTerlambat'])->name('index');
        Route::get('/{id}/show', [PembimbingController::class, 'show'])->name('show');
        Route::get('/cetak-surat/{id}', [PembimbingController::class, 'generatePDF'])->name('cetak');
    });
    Route::get('/ps/export-lates', [PembimbingController::class, 'exportSiswaPerRayon'])->name('ps.export.lates');
});
