<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\PublicController::class, 'index'])->name('welcome');
Route::post('/opportunities/{id}',  [PublicController::class, 'store'])->name('simpanDt');
Route::get('/opportunities/{id}', [PublicController::class, 'show'])->name('show');


Route::get('/coming-soon', function () {
    return view('comingsoon');
})->name('comingsoon');

Route::get('/applicant', function () {
    return view('applicant-menu');
})->middleware(['auth', 'verified'])->name('applicant');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/users', function () {
    return view('users-management');
})->middleware(['auth', 'verified'])->name('users');

Route::get('/categories', function () {
    return view('category-management');
})->middleware(['auth', 'verified'])->name('categories');

Route::get('/divisions', function () {
    return view('divisi-management');
})->middleware(['auth', 'verified'])->name('divisions');

Route::get('/opportunities', function () {
    return view('opportunity-management');
})->middleware(['auth', 'verified'])->name('opportunities');

Route::get('/applicants', function () {
    return view('applicant-manegement');
})->middleware(['auth', 'verified'])->name('applicants');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
