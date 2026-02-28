<?php

use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\ProfileController;
use App\Models\Colocation;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // colocations
    Route::resource('colocations', ColocationController::class);

    // depenses
    Route::post('colocations/{colocation}/depenses', [DepenseController::class, 'store'])
        ->name('depenses.store');

    Route::delete('colocations/{colocation}/depenses/{depense}', [DepenseController::class, 'destroy'])
        ->name('depenses.destroy');

    // admin dashboard
    Route::get('/admin/dashboard', function () {
        $colocations = Colocation::with('memberships')->latest()->get();
        return view('dashboard', compact('colocations'));
    })->name('admin.dashboard');

    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
