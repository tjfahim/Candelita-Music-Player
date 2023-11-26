<?php

use App\Http\Controllers\Api\LivePlayerManageControllerApi;
use App\Http\Controllers\Api\SettingsControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/music', [LivePlayerManageControllerApi::class, 'index']);
Route::get('/music/{id}', [LivePlayerManageControllerApi::class, 'show']);
Route::post('/music', [LivePlayerManageControllerApi::class, 'store']);
Route::put('/music/{id}', [LivePlayerManageControllerApi::class, 'update']);
Route::put('/music-updatelistening/{id}', [LivePlayerManageControllerApi::class, 'updatelistening']);
Route::delete('/music/{id}', [LivePlayerManageControllerApi::class, 'destroy']);

Route::get('/settings', [SettingsControllerApi::class, 'index']);
Route::get('/settings/{id}', [SettingsControllerApi::class, 'show']);
Route::post('/settings', [SettingsControllerApi::class, 'store']);
Route::put('/settings/{id}', [SettingsControllerApi::class, 'update']);
Route::delete('/settings/{id}', [SettingsControllerApi::class, 'destroy']);
