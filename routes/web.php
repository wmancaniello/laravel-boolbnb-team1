<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FlatsController;
use App\Http\Controllers\Admin\MessagesController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\BraintreeController;
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
    return view('auth/login');
});


Route::middleware('auth')
    ->prefix('admin') // Prefisso nell'url delle rotte di questo gruppo
    ->name('admin.') // inizio di ogni nome delle rotte del gruppo
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('flats', FlatsController::class)->parameters(['flats' => 'flat:slug']);
        Route::resource('messages', MessagesController::class);
        // Pagamenti
        Route::get('client_token', [BraintreeController::class, 'generateToken'])->name('client_token');
        Route::post('checkout', [BraintreeController::class, 'checkout'])->name('checkout');
    });
    
    require __DIR__ . '/auth.php';
    
    /* Route::get('payment/generate', [PaymentController::class, 'generate']);
    Route::post('payment/makepayment', [PaymentController::class, 'makePayment']); */
    
    