<?php

use App\Http\Controllers\API\ProdakController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\ProdukController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [UserController::class, 'register']);

Route::post('login', [UserController::class, 'login']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->group(function(){

    Route::get('user',[UserController::class, 'fetch']);
    Route::get('logout', [UserController::class, 'logout']);
    Route::get('produk', [ProdakController::class, 'semua']);
    Route::get('jasa', [ProdakController::class, 'semuajasa']);
    Route::post('upload', [ProdakController::class,'upload']);
    Route::get('logout', [UserController::class,'logout']);
    Route::post('pay',[paymentController::class,'payProduk'] ); 
    Route::get('rekuest/{user_id}', [ProdakController::class,'rekuest']);
});
