<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\WisataController;
use App\Http\Controllers\API\FasilitasController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\RatingController;
use App\Http\Controllers\API\TotalRatingController;
use App\Http\Controllers\API\WisatawanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('login',[AuthController::class, 'login']);
//  Route::group(['middleware'=>'auth:sanctum'], function(){
//     Route::get('wisata', [WisataController::class, 'index']);
//     Route::get('wisata/{id}', [WisataController::class, 'show']);
//     Route::get('kategori', [KategoriController::class, 'index']);
//     Route::get('/kategori/{id}', [KategoriController::class, 'show']);
//     Route::get('fasilitas', [FasilitasController::class, 'index']);
//     Route::get('/fasilitas/{id}', [FasilitasController::class, 'show']);

//     Route::post('/wisata', [WisataController::class, 'store']);
//     Route::post('/kategori', [KategoriController::class, 'store']);
//     Route::post('/fasilitas', [FasilitasController::class, 'store']);
//     Route::post('/wisata/{id}', [WisataController::class, 'update']);
//     Route::post('/kategori/{id}', [KategoriController::class, 'update']);
//     Route::post('/fasilitas/{id}', [FasilitasController::class, 'update']);
    
//     Route::delete('/wisata/{id}', [WisataController::class, 'destroy']);
//     Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);
//     Route::delete('/fasilitas/{id}', [FasilitasController::class, 'destroy']);
//  });

Route::get('wisata', [WisataController::class, 'index']);
// Route::get('wisata/{cari}', [WisataController::class, 'search']);
Route::get('wisata/{id}', [WisataController::class, 'show']);
Route::get('kategori', [KategoriController::class, 'index']);
Route::get('/kategori/{id}', [KategoriController::class, 'show']);
Route::get('wisataKategori/{filter}', [WisataController::class, 'filter']);
Route::get('fasilitas', [FasilitasController::class, 'index']);
Route::get('fasilitas/{id}', [FasilitasController::class, 'show']);
Route::put('wisata/{id}', [WisataController::class, 'update']);

Route::post('login', [WisatawanController::class, 'login']);
Route::get('/getLogin', [WisatawanController::class], 'getLogin');
Route::post('register', [WisatawanController::class, 'register'])->name('register');
Route::post('logout', [WisatawanController::class, 'logout'])->name('logout');
Route::get('checkLoggedIn', [WisatawanController::class, 'checkLoggedIn']);

Route::post('rating', [RatingController::class, 'store']);
Route::get('rating', [RatingController::class, 'index']);
Route::get('totalrating', [RatingController::class, 'total']);
Route::get('review', [RatingController::class, 'review']);
Route::get('rating/{id_wisata}', [RatingController::class, 'getRatingByWisata']);






// Route::get('fasilitas', [FasilitasController::class, 'index']);
// Route::get('/fasilitas/{id}', [FasilitasController::class, 'show']);
