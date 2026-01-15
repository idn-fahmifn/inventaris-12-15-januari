<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// admin

Route::prefix('admin')->middleware(['auth', 'verified', 'admin'])->group(function () {

    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

    // Route Ruangan
    Route::get('rooms', [RoomController::class, 'index'])->name('room.index');
    Route::post('rooms', [RoomController::class, 'store'])->name('room.store');
    Route::get('rooms/{parameter}', [RoomController::class, 'show'])->name('room.show');
    Route::put('rooms/{parameter}', [RoomController::class, 'update'])->name('room.update');
    Route::delete('rooms/{parameter}', [RoomController::class, 'destroy'])->name('room.destroy');

    // Route Item
    Route::get('items', [ItemController::class, 'index'])->name('item.index');
    Route::post('items', [ItemController::class, 'store'])->name('item.store');
    Route::get('items/{parameter}', [ItemController::class, 'show'])->name('item.show');
    Route::put('items/{parameter}', [ItemController::class, 'update'])->name('item.update');
    Route::delete('items/{parameter}', [ItemController::class, 'destroy'])->name('item.destroy');

});


// petugas
Route::prefix('petugas')->middleware(['auth', 'verified'])->group(function () {

    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'petugas'])->name('dashboard.petugas');

});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
