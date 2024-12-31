<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FileUploadController;

// Authentication Routes
Route::get('register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

// Login Routes
Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

// File Upload Route
Route::post('upload', [FileUploadController::class, 'upload'])->middleware('auth')->name('file.upload');
// Route for downloading the file
Route::get('download/{filename}', [FileUploadController::class, 'download'])->middleware('auth')->name('download');
// Add this to your routes/web.php file
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');



// Protected Routes (only accessible for authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('users/onepageweb', [FileUploadController::class, 'redirectToDashboard'])->name('users.onepageweb');
    Route::get('/dashboard', [ProfileController::class, 'show'])->name('dashboard');
});
