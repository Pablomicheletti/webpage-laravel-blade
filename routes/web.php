<?php
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Chirp;

Route::view('/','welcome')->name('welcome');





Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/chirps', [ChirpController::class, 'index'])->name('chirps.index');

    Route::post('/chirps', function () {
        
        Chirp::create([
            'message'=> request ('message'),
            'user_id'=> auth()->id(),
        ]);


        return to_route('chirps.index')
        ->with('status', __('Chirp was created successfully!'));
    });

});

require __DIR__.'/auth.php';
