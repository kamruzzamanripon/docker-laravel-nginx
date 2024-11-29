<?php

use App\Http\Controllers\MyPage;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Route;

Route::withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class])
    ->group(function () {
        // Các route không cần CSRF
        Route::post('/api/regions', [RegionController::class, 'create']);
        Route::put('/api/regions/{id}', [RegionController::class, 'update']);
        Route::delete('/api/regions/{id}', [RegionController::class, 'delete']);
    });
Route::get('/api/regions', [RegionController::class, 'getAll']);
Route::get('/mypage/regions', [MyPage::class, 'Regions']);

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

require __DIR__.'/auth.php';
