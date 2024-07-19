<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FlatController;
// Messaggi
use App\Http\Controllers\Admin\MessagesController;


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

Route::get('/flats', [FlatController::class, 'index']);
Route::get('/flats/{slug}', [FlatController::class, 'show']);

// Messaggi
Route::post('/messages', [MessagesController::class, 'store']);

