<?php

use App\Http\Controllers\cetakPdf;
use App\Http\Controllers\ctrlPembayaran;
use App\Http\Controllers\UserController;
use App\Models\mdlPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

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
    return view('landing', ['title' => 'Home']);
})->name('home');

// Route::get('storage/{filename}', function ($filename) {

//     return redirect('/login');
// })->name('get-image');

//Route::get('register', [UserController::class, 'register'])->name('register');
//Route::post('register', [UserController::class, 'register_action'])->name('register.action');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');
//Route::get('password', [UserController::class, 'password'])->name('password');
//Route::post('password', [UserController::class, 'password_action'])->name('password.action');
Route::get('logout', [UserController::class, 'logout'])->name('logout');


// Route::get('dt-pembayaran', [ctrlPembayaran::class, 'index'])->name('dt-pembayaran');
// Route::get('dt-pembayaran', [ctrlPembayaran::class, 'index'])->name('view-create-dt-pembayaran');
// Route::get('dt-pembayaran', [ctrlPembayaran::class, 'index'])->name('view-create-dt-pembayaran');


Route::resource('dt-pembayaran', ctrlPembayaran::class);
Route::get('delete-image/{id}', [ctrlPembayaran::class, 'deleteimage']);
Route::post('store-whitout-login', function (Request $request) {
    $messages = [
        'nama.required' => 'Nama wajib diisi',
        'alamat.required' => 'Alamat wajib diisi',
        'noTelp.required' => 'No.Telp wajib diisi',
        'jenisKelamin.required' => 'Jenis kelamin wajib diisi',
        'jumlah.required' => 'Jumlah wajib diisi',
        'img.required' => 'Bukti wajib diisi',


    ];
    $rules = [
        'nama' => 'required',
        'alamat' => 'required',
        'noTelp' => 'required',
        'jenisKelamin' => 'required',
        'jumlah' => 'required',
        'img' => 'required|mimes:jpg,jpeg,png|max:2048',

    ];
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
        // dd($validator->errors());
        return redirect()->back()->withErrors($validator->errors());
    }
    $ext = pathinfo($request->file('img')->getClientOriginalName(), PATHINFO_EXTENSION);
    $fileName = 'bukti_' . $request->nama . '_' . date('d-m-Y') . '.' . $ext;
    $resi = '';
        $i = 0;
        for ($i; $i < 15; $i++) {
            $resi .= random_int(0, 9);
        }
    $data = [
        'resi' => $resi,
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'noTelp' => $request->noTelp,
        'jenisKelamin' => $request->jenisKelamin,
        'jumlah' => $request->jumlah,
        'img' => $fileName,

    ];

    mdlPembayaran::create($data);

    $path = public_path() . '/storage';
    $request->file('img')->move($path, $fileName);
    $data = mdlPembayaran::where('nama', $data['nama'])->where('alamat', $data['alamat'])->where('noTelp', $data['noTelp'])->first();
    // // dd($data);
    return redirect('/');
});
// public function get_resi()
//     {
//         $resi = '';
//         $i = 0;
//         for ($i; $i < 15; $i++) {
//             $resi .= random_int(0, 9);
//         }
//         // dd($resi);
//         return $resi;
//     }
// Route::get('dt-pembayaran',[ctrlPembayaran::class, 'index'])->name('dt-pembayaran.index');
// Routpo::get('dt-pembayaran',[ctrlPembayaran::class, 'index'])->name('dt-pembayaran.index');
// Route::get('dt-pembayaran/create',[ctrlPembayaran::class, 'index'])->name('dt-pembayaran.create');
// Route::post('dt-pembayaran/store',[ctrlPembayaran::class, 'index'])->name('dt-pembayaran.store');
// Route::get('dt-pembayaran/{id}/edit',[ctrlPembayaran::class, 'index'])->name('dt-pembayaran.edit');
// Route::post('dt-pembayaran/{id}/update',[ctrlPembayaran::class, 'index'])->name('dt-pembayaran.update');
// Route::get('dt-pembayaran/{id}/delete',[ctrlPembayaran::class, 'index'])->name('dt-pembayaran.delete');
// Route::get()
Route::get('preview-pdf/{id}', [cetakPdf::class, 'preview_pdf']);
Route::get('cetak-pdf/{id}', [cetakPdf::class, 'cetak_pdf']);
