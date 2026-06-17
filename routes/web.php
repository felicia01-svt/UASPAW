<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

// ─── Guest Routes ─────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// ─── Authenticated Routes ─────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [NoteController::class, 'index'])->name('dashboard');

    // Notes CRUD
    Route::get('/notes/create',      [NoteController::class, 'create'])->name('notes.create');
    Route::post('/notes',            [NoteController::class, 'store'])->name('notes.store');
    Route::get('/notes/{note}', [NoteController::class, 'show'])->name('notes.show');
    Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');
    Route::put('/notes/{note}',      [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/notes/{note}',   [NoteController::class, 'destroy'])->name('notes.destroy');
});
