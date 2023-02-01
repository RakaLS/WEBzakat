<?php

namespace App\Http\Controllers;

use App\Models\mdlPembayaran;
use Illuminate\Http\Request;
use PDF;

class cetakPdf extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function preview_pdf($id)
    {
        // dd($id);
        $data = mdlPembayaran::where('id', $id)->first();
        return view('pdf',['data'=> $data]);
    }
    public function cetak_pdf($id)
    {
        $data = mdlPembayaran::where('id', $id)->first();
        $nama = $data->nama;
        $pdf = PDF::loadview('pdf', ['data' => $data]);
        return $pdf->download(strval($nama).' - Permata Zakat'.'.pdf');
    }
}
