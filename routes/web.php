<?php

use App\Http\Controllers\WEB\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WEB\WebWisataController;
use App\Http\Controllers\WEB\WebFasilitasController;

use App\Http\Controllers\WEB\WebKategoriController;
use Illuminate\Support\Facades\Route;
use App\Models\Wisata;
use App\Models\Kategori;
use App\Models\Fasilitas;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


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

// Route::get('admin', [WebWisataController::class, 'index']);


// Route::get('/login', function () {
//     return view('admin.login');
// })->name('login');
require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('auth\login');
}); 

// Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
// Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::group(['middleware' => ['auth']], function(){
Route::middleware('auth')->group(function (){
    Route::get('/wisata', [WebWisataController::class, 'index'])->name('dataWisata');
    Route::get('/printdatawisata', [WebWisataController::class, 'cetakdatawisata'])->name('printdata');
    Route::get('wisata/tambah', [WebWisataController::class, 'create']);
    Route::get('wisata/{id_wisata}/edit' , [WebWisataController::class, 'edit']);
    Route::get('wisata/{id_wisata}/detail' , [WebWisataController::class, 'show']);
    Route::post('/wisata', [WebWisataController::class, 'store']);
    Route::put('wisata/{id_wisata}', [WebWisataController::class, 'update']);
    Route::delete('wisata/{id_wisata}', [WebWisataController::class, 'destroy']);

    Route::get('/kategori', [WebKategoriController::class, 'index'])->name('dataKategori');
    Route::get('/printdatakategori', [WebKategoriController::class, 'cetakdatakategori'])->name('printdata');
    Route::get('kategori/tambah', [WebKategoriController::class, 'create']);
    Route::post('/kategori', [WebKategoriController::class, 'store']);
    Route::get('kategori/{id_kategori}/edit' , [WebKategoriController::class, 'edit']);
    Route::patch('kategori/{id_kategori}', [WebKategoriController::class, 'update']);
    Route::delete('kategori/{id_kategori}', [WebKategoriController::class, 'destroy']);

    Route::get('/fasilitas', [WebFasilitasController::class, 'index'])->name('dataFasilitas');
    Route::get('/printdatafasilitas', [WebFasilitasController::class, 'cetakdatafasilitas'])->name('printdata');
    Route::get('fasilitas/tambah', [WebFasilitasController::class, 'create']);
    Route::post('/fasilitas', [WebFasilitasController::class, 'store']);
    Route::get('fasilitas/{id_fasilitas}/edit' , [WebFasilitasController::class, 'edit']);
    Route::patch('fasilitas/{id_fasilitas}', [WebFasilitasController::class, 'update']);
    Route::delete('fasilitas/{id_fasilitas}', [WebFasilitasController::class, 'destroy']);

    Route::get('dasboard', [WebWisataController::class, 'dasboard'])->middleware('auth')->name('dasboard');
    
    // Route::get('dasboard', function(){
    //     $wisata = Wisata::count();
    //     $kategori = Kategori::count();
    //     return view('admin.dasboard', compact('wisata', 'kategori'));
    // })->middleware('auth')->name('dasboard');

}); 




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
