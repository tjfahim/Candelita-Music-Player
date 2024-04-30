<?php

use App\Http\Controllers\LivePlayerManageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    if (Auth::check()) {
        $user = Auth::user();
        $role = $user->role; 
        if ($role === 'admin') {
            return view('admin.music');
        }
    }

    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'role:admin'], function () {
            Route::get('/music', [LivePlayerManageController::class, 'index'])->name('music.list');
            Route::get('/music-add', [LivePlayerManageController::class, 'create'])->name('music.create');
            Route::post('/music-add', [LivePlayerManageController::class, 'store'])->name('music.store');
            Route::get('/music-edit/{id}', [LivePlayerManageController::class, 'edit'])->name('music.edit');
            Route::put('/music-update/{id}', [LivePlayerManageController::class, 'update'])->name('music.update');
            Route::post('/music-destroy/{id}', [LivePlayerManageController::class, 'destroy'])->name('music.destroy');

            Route::get('/settings', [SettingsController::class, 'index'])->name('settings.list');
            Route::put('/settings-update', [SettingsController::class, 'update'])->name('settings.update');

    });

 
});
