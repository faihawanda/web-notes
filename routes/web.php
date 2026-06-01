<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubtaskController; // Kita kumpulin di atas biar rapi
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

    // Route Task Management
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    //  BARIS LANGKAH TERAKHIR: Route untuk pindah status dari To-Do -> In Progress -> Done
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

    // Route Subtasks (Menggunakan SubtaskController yang benar)
    Route::post('/tasks/{task}/subtasks', [TaskController::class, 'storeSubtask'])->name('subtasks.store');
    Route::delete('/subtasks/{subtask}', [SubtaskController::class, 'destroy'])->name('subtasks.destroy');
    Route::patch('/subtasks/{subtask}/toggle', [SubtaskController::class, 'toggle'])->name('subtasks.toggle');
});

require __DIR__ . '/auth.php';
