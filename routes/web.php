<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
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

// --- SEMUA ROUTE YANG BUTUH LOGIN TARUH DI DALAM GRUP INI ---
Route::middleware('auth')->group(function () {
    // Route Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route Task Management (Mutiara)
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    
    // ✨ Route pindah status otomatis (To-Do -> In Progress -> Done)
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

    // --- AREA ROUTE SUBTASKS (Mutiara) ---
    Route::post('/tasks/{task}/subtasks', [TaskController::class, 'storeSubtask'])->name('subtasks.store');
    Route::delete('/subtasks/{subtask}', [TaskController::class, 'destroySubtask'])->name('subtasks.destroy');
    Route::patch('/subtasks/{subtask}/toggle', [TaskController::class, 'toggleSubtask'])->name('subtasks.toggle');

    // --- ROUTE FITUR FITUR LAIN (Main Server) ---
    // Category
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('category.index'); 
        Route::post('/category/store', 'store')->name('category.store'); 
        Route::put('/category/update/{id}', 'update')->name('category.update');
        Route::delete('/category/destroy/{id}', 'destroy')->name('category.destroy');
    });

    // All Notes
    Route::controller(NotesController::class)->group(function () {
        Route::get('/notes', 'index')->name('allnotes.index');
    });

    // Task List
    Route::controller(NotesController::class)->group(function () {
        Route::get('/tasklist', 'index')->name('tasklist.index'); 
    });
});

require __DIR__ . '/auth.php';