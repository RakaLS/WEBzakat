<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cetakPdf;
use App\Http\Controllers\ctrlPembayaran;
use App\Http\Controllers\data_pembayaran;


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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});

Route::resource('data_pembayaran',ctrlPembayaran::class);
Route::get('preview-pdf/{id}',[cetakPdf::class, 'preview_pdf']);
Route::get('cetak-pdf/{id}',[cetakPdf::class, 'cetak_pdf']);
