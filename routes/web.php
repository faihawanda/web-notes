<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AllNotesController;
use App\Http\Controllers\SubtaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// User Account
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Task Manager (Mutiara)
Route::controller(TaskController::class)->group(function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

    // Substask
        Route::post('/tasks/{task}/subtasks', [TaskController::class, 'storeSubtask'])->name('subtasks.store');
        Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
        Route::delete('/subtasks/{subtask}', [TaskController::class, 'destroySubtask'])->name('subtasks.destroy');
        Route::patch('/subtasks/{subtask}/toggle', [TaskController::class, 'toggleSubtask'])->name('subtasks.toggle');
});

// Notes Category
Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('category.index'); 
        Route::post('/category/store', 'store')->name('category.store'); 
        Route::put('/category/update/{id}', 'update')->name('category.update');
        Route::delete('/category/destroy/{id}', 'destroy')->name('category.destroy');
});

// All Notes (Hani)
Route::controller(AllNotesController::class)->group(function () {
    Route::get('/notes', 'index')->name('allnotes.index');
    Route::post('/notes/store', 'store')->name('allnotes.store');
    Route::put('/notes/update/{id}', 'update')->name('allnotes.update');
    Route::delete('/notes/destroy/{id}', 'destroy')->name('allnotes.destroy');
});

require __DIR__ . '/auth.php';