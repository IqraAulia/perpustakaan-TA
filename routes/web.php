<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ListBukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\PengarangController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\ReqBukuController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'kategori', 'as' => 'kategori.',], function () {
    Route::get('/', [KategoriController::class, 'index'])->name('index');
    Route::post('/store', [KategoriController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [KategoriController::class, 'edit'])->name('edit');
    Route::post('/{id}/update', [KategoriController::class, 'update'])->name('update');
    Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
});

Route::group(['prefix' => 'pengarang', 'as' => 'pengarang.',], function () {
    Route::get('/', [PengarangController::class, 'index'])->name('index');
    Route::post('/store', [PengarangController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [PengarangController::class, 'edit'])->name('edit');
    Route::post('/{id}/update', [PengarangController::class, 'update'])->name('update');
    Route::delete('/{id}', [PengarangController::class, 'destroy'])->name('kategori.destroy');
});

Route::group(['prefix' => 'penerbit', 'as' => 'penerbit.',], function () {
    Route::get('/', [PenerbitController::class, 'index'])->name('index');
    Route::post('/store', [PenerbitController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [PenerbitController::class, 'edit'])->name('edit');
    Route::post('/{id}/update', [PenerbitController::class, 'update'])->name('update');
    Route::delete('/{id}', [PenerbitController::class, 'destroy'])->name('kategori.destroy');
});

Route::group(['prefix' => 'buku', 'as' => 'buku.',], function () {
    Route::get('/', [BukuController::class, 'index'])->name('index');
    Route::post('/store', [BukuController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [BukuController::class, 'edit'])->name('edit');
    Route::post('/{id}/update', [BukuController::class, 'update'])->name('update');
    Route::delete('/{id}', [BukuController::class, 'destroy'])->name('kategori.destroy');
});

Route::group(['prefix' => 'list-buku', 'as' => 'list-buku.',], function () {
    Route::get('/', [ListBukuController::class, 'index'])->name('index');
    Route::post('/store', [ListBukuController::class, 'store'])->name('store');
    Route::post('/update', [ListBukuController::class, 'update'])->name('update');
    Route::delete('/destroy', [ListBukuController::class, 'destroy'])->name('destroy');
});


Route::group(['prefix' => 'user', 'as' => 'user.',], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::post('/{id}/update', [UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'anggota', 'as' => 'anggota.',], function () {
    Route::get('/', [AnggotaController::class, 'index'])->name('index');
    Route::post('/store', [AnggotaController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [AnggotaController::class, 'edit'])->name('edit');
    Route::post('/{id}/update', [AnggotaController::class, 'update'])->name('update');
    Route::delete('/{id}', [AnggotaController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'peminjaman', 'as' => 'peminjaman.',], function () {
    Route::get('/', [PeminjamanController::class, 'index'])->name('index');
    Route::get('/detail', [PeminjamanController::class, 'detail'])->name('detail');
    Route::post('/store', [PeminjamanController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [PeminjamanController::class, 'edit'])->name('edit');
    Route::post('/{id}/update', [PeminjamanController::class, 'update'])->name('update');
    Route::delete('/destroy', [PeminjamanController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'pengembalian', 'as' => 'pengembalian.',], function () {
    Route::get('/', [PengembalianController::class, 'index'])->name('index');
    Route::get('/detail', [PengembalianController::class, 'detail'])->name('detail');
    Route::post('/store', [PengembalianController::class, 'store'])->name('store');
    Route::post('/update', [PengembalianController::class, 'update'])->name('update');
    Route::delete('/destroy', [PengembalianController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'riwayat', 'as' => 'riwayat.',], function () {
    Route::get('/', [RiwayatController::class, 'index'])->name('index');
    Route::get('/detail', [RiwayatController::class, 'detail'])->name('detail');
    Route::post('/store', [RiwayatController::class, 'store'])->name('store');
    Route::post('/update', [RiwayatController::class, 'update'])->name('update');
    Route::delete('/destroy', [RiwayatController::class, 'destroy'])->name('destroy');
});



Route::group(['prefix' => 'pinjam', 'as' => 'pinjam.',], function () {
    Route::get('/', [PinjamController::class, 'index'])->name('index');
    Route::post('/store', [PinjamController::class, 'store'])->name('store');
    Route::post('/update', [PinjamController::class, 'update'])->name('update');
    Route::delete('/destroy', [PinjamController::class, 'destroy'])->name('destroy');
});

Route::group(['prefix' => 'req-buku', 'as' => 'req-buku.',], function () {
    Route::get('/', [ReqBukuController::class, 'index'])->name('index');
    Route::post('/store', [ReqBukuController::class, 'store'])->name('store');
    Route::post('/update', [ReqBukuController::class, 'update'])->name('update');
    Route::delete('/destroy', [ReqBukuController::class, 'destroy'])->name('destroy');
});




Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/tables', function () {
    return view('komponen.tables');
})->name('tables');

