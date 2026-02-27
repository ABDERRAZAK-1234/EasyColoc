<?php

use App\Http\Controllers\ColocationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\Colocation;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [HomeController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/index', [HomeController::class, 'index'])->name('index');
});

Route::middleware('auth')->group(function () {
    Route::resource('colocations', ColocationController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        $colocations = Colocation::with('memberships')->latest()->get();
        return view('dashboard', compact('colocations'));
    })->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
