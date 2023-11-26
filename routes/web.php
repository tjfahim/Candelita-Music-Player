<?php

use App\Http\Controllers\LivePlayerManageController;
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
    // Check if the user is authenticated
    if (Auth::check()) {
        $user = Auth::user();
        $role = $user->role; // Get the user's role

        // Check the user's role and redirect accordingly
        if ($role === 'admin') {
            return view('admin.dashboard'); // Render the admin dashboard view
        } elseif ($role === 'user') {
            return view('user.dashboard'); // Render the user dashboard view
        }
    }

    // Redirect to the login page if the user is not authenticated or has no role
    return redirect('/login');
});


Route::get('/login', 'App\Http\Controllers\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'role:admin'], function () {
        Route::get('/dashboard', 'App\Http\Controllers\AdminController@dashboard')->name('admin.dashboard');
    });

    Route::group(['prefix' => 'user', 'middleware' => 'role:user'], function () {
        Route::get('/dashboard', 'App\Http\Controllers\UserController@dashboard')->name('user.dashboard');
    });
});

Route::get('/', [LivePlayerManageController::class, 'index'])->name('music.list');
Route::get('/music-add', [LivePlayerManageController::class, 'create'])->name('music.create');
Route::post('/music-add', [LivePlayerManageController::class, 'store'])->name('music.store');
Route::get('/music-edit/{id}', [LivePlayerManageController::class, 'edit'])->name('music.edit');
Route::put('/music-update/{id}', [LivePlayerManageController::class, 'update'])->name('music.update');
Route::post('/music-destroy/{id}', [LivePlayerManageController::class, 'destroy'])->name('music.destroy');

Route::get('/settings', [SettingsController::class, 'index'])->name('settings.list');
Route::get('/settings-add', [SettingsController::class, 'create'])->name('settings.create');
Route::post('/settings-add', [SettingsController::class, 'store'])->name('settings.store');
Route::get('/settings-edit/{id}', [SettingsController::class, 'edit'])->name('settings.edit');
Route::put('/settings-update/{id}', [SettingsController::class, 'update'])->name('settings.update');
Route::post('/settings-destroy/{id}', [SettingsController::class, 'destroy'])->name('settings.destroy');
