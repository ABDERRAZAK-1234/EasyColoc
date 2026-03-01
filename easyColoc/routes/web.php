<?php

use App\Enums\UserRole;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // user profile
    Route::get('/colocations/profile', function () {
        return view('colocations.profile');
    })->name('colocations.profile');


    // colocation
    Route::resource('colocations', ColocationController::class);


    // depence
    Route::post('colocations/{colocation}/depenses', [DepenseController::class, 'store'])
        ->name('depenses.store');

    Route::delete('colocations/{colocation}/depenses/{depense}', [DepenseController::class, 'destroy'])
        ->name('depenses.destroy');


    // dashboard
    Route::get('/dashboard', function () {

        $user = auth()->user();

        // dashboard admin
        if ($user->role === UserRole::ADMIN) {
            return redirect()->route('admin.dashboard');
        }

        //  profile colocation
        if ($user->role === UserRole::USER) {
            return redirect()->route('colocations.profile');
        }

        return redirect('/');
    })->name('dashboard');


    // ADMIN PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
