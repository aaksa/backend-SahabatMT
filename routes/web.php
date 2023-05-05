<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RequestController;
use App\Models\Jasa;
use App\Models\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/
Route::middleware('auth')->group(function(){

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('produk/barang' , [ProdukController::class,'showProduk'])->name('show-produk');
    Route::post('produk/barang', [ProdukController::class, 'storeProduk'])->name('show-produk');
    Route::delete('/produk/barang/{id}', [ProdukController::class, 'deleteProduk'])->name('delete-produk');
    Route::get('/produk/barang/{id}/edit',[ProdukController::class, 'editProduk'])->name('edit-produk');
    Route::put('/produk/barang/{id}',[ProdukController::class, 'updateProduk']);

    Route::get('produk/jasa' , [JasaController::class,'showJasa'])->name('show-jasa');
    Route::post('produk/jasa' , [JasaController::class,'storeJasa'])->name('show-jasa');
    Route::delete('/produk/jasa/{id}' ,[JasaController::class,'deleteJasa'])->name('delete-jasa');
    Route::get('/produk/jasa/{id}/edit',[JasaController::class, 'editJasa'])->name('edit-jasa');
    Route::put('/produk/jasa/{id}', [JasaController::class, 'updateJasa']);


    Route::get('/request' , [RequestController::class, 'showRequest'])->name('show-request');
    Route::get('/request/accepted' , [RequestController::class, 'showaccepted'])->name('show-request-acc');
    Route::get('/request/rejected' , [RequestController::class, 'showrejected'])->name('show-request-dec');

    Route::put('/request/{id}',[RequestController::class, 'onclickrequest'])->name('onclick-request');
    Route::delete('/request/{id}',[RequestController::class, 'deleteRequest'])->name('delete-request');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


    // Route::put('/request/reject/{id}',[RequestController::class, 'rejectRequest'])->name('reject-request');

});

Route::middleware('guest')->group(function(){
    Route::get('/Login' ,[LoginController::class , 'login'] )->name('login');
    Route::post('/Login' ,[LoginController::class , 'store'] );

    Route::fallback(function(){
        return redirect()->route('/');
    });
});

// Route::get('/show-nelayan',[UserController::class, 'showNelayan'])->name('show-nelayan');
// Route::post('/show-nelayan', [UserController::class, 'storeNelayan']);



// 404 for undefined routes
Route::any('/{page?}',function(){
    return View::make('error.404');
})->where('page','.*');




