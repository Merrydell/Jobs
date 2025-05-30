<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Student dashboard route (accessible without authentication)
Route::get('/student-dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');

// Jobs routes
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
Route::post('/jobs/{id}/approve', [JobController::class, 'approve'])->name('jobs.approve');
Route::post('/jobs/{id}/decline', [JobController::class, 'decline'])->name('jobs.decline');
Route::post('/jobs/{id}/taken', [JobController::class, 'markAsTaken'])->name('jobs.taken');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
