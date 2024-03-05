<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','role:user'])->name('dashboard');

Route::get('/userprofile',[DashboardController::class,'Index']);
Route::get('/userprofile1',[DashboardController::class,'Index1']);
Route::get('/userprofile2',[DashboardController::class,'Index2']);
Route::get('/userprofile3',[DashboardController::class,'Index3']);

Route::middleware(['auth','role:user'])->group(function(){
    Route::controller(DashboardController::class)->group(function(){
        Route::get('/userprofile','Index');
        Route::get('/userprofile1','Index1');
        Route::get('/userprofile2','Index2');
        Route::get('/userprofile3','Index3');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
