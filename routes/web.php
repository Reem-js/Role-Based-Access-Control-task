<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;


Route::get('/', [TaskController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/tasks/{task}/assign', [TaskController::class, 'assignTaskRoundRobin'])->name('tasks.assign')->middleware('auth');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');
Route::get('/tasks/efficiency', [TaskController::class, 'calculateEfficiency'])->name('tasks.efficiency')->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tasks', TaskController::class);
    
});

require __DIR__.'/auth.php';
