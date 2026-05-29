<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\TaskListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Category
Route::middleware('auth')->controller(CategoryController::class)->group(function () {
    Route::get('/category', 'index')->name('category.index'); 
    Route::post('/category/store', 'store')->name('category.store'); 
    Route::put('/category/update/{id}', 'update')->name('category.update');
    Route::delete('/category/destroy/{id}', 'destroy')->name('category.destroy');
});

// All Notes
Route::middleware('auth')->controller(NotesController::class)->group(function () {
    Route::get('/notes', 'index')->name('allnotes.index'); 
});

// Task List
Route::middleware('auth')->controller(NotesController::class)->group(function () {
    Route::get('/tasklist', 'index')->name('tasklist.index'); 
});

require __DIR__.'/auth.php';
