<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Route halaman utama
Route::get('/', [PublicController::class, 'index'])->name('welcome');

// Route untuk menampilkan dan menyimpan data berdasarkan opportunity
Route::post('/opportunities/{id}', [PublicController::class, 'store'])->name('simpanDt');
Route::get('/opportunities/{id}', [PublicController::class, 'show'])->name('show');

// Route coming soon
Route::get('/coming-soon', function () {
    return view('comingsoon');
})->name('comingsoon');

// Route dashboard dan manajemen konten
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/users', function () {
        return view('users-management');
    })->name('users');

    Route::get('/categories', function () {
        return view('category-management');
    })->name('categories');

    Route::get('/divisions', function () {
        return view('divisi-management');
    })->name('divisions');

    Route::get('/opportunities', function () {
        return view('opportunity-management');
    })->name('opportunities');
});

// Route profile management dengan middleware auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route autentikasi
require __DIR__.'/auth.php';
