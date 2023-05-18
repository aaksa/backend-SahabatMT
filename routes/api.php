<?php

use App\Http\Controllers\API\ProdakController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [UserController::class, 'register']);

Route::post('login', [UserController::class, 'login']);
Route::post('forgot', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.reset');

Route::get('paycall',[paymentController::class, 'handlePaymentCallback']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->group(function(){

    Route::get('user',[UserController::class, 'fetch']);
    Route::put('users/{id}' ,[UserController::class, 'update'])->name('users.update');
    Route::get('logout', [UserController::class, 'logout']);
    Route::get('produk', [ProdakController::class, 'semua']);
    Route::get('jasa', [ProdakController::class, 'semuajasa']);
    Route::post('upload', [ProdakController::class,'upload']);
    Route::get('logout', [UserController::class,'logout']);
    Route::post('pay',[paymentController::class,'payProduk'] ); 
    Route::post('transaksi',[paymentController::class,'createRiwayat']);
    Route::get('rekuest/{user_id}', [ProdakController::class,'rekuest']);
    Route::get('transaction/{email}', [TransactionController::class,'getTransactionuser']);
    Route::get('article', [ArtikelController::class, 'fetchArtikel']);
});
