<?php

namespace App\Http\Controllers;
use DB;

use App\Models\mdlPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ctrlPembayaran extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 20;
        if (strlen($katakunci)) {
            $data = mdlPembayaran::where('id', 'like', "%$katakunci%")
                ->orWhere('nama', 'like', "%$katakunci%")
                ->orWhere('alamat', 'like', "%$katakunci%")
                ->orWhere('noTelp', 'like', "%$katakunci%")
                ->orWhere('jenisKelamin', 'like', "%$katakunci%")
                ->orWhere('jumlah', 'like', "%$katakunci%")
                ->paginate($jumlahbaris);
        } else {
            $data = mdlPembayaran::orderBy('id', 'desc')->paginate($jumlahbaris);
        }
        
        $statistik = DB::select("CALL get_statistik()");
        return view('index', [
            'data'=> $data,
            'statistik' => $statistik,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Session::flash('nama', $request->nama);
        Session::flash('alamat', $request->jurusan);
        Session::flash('noTelp', $request->nim);
        Session::flash('jenisKelamin', $request->nim);
        Session::flash('jumlah', $request->nim);

        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'noTelp' => 'required',
            'jenisKelamin' => 'required',
            'jumlah' => 'required',
            
        ], [
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'noTelp.required' => 'No.Telp wajib diisi',
            'jenisKelamin.required' => 'Jenis kelamin wajib diisi',
            'jumlah.required' => 'Jumlah wajib diisi',
           
            
        ]);
        $data = [
            'resi'=> strval($this->get_resi()),
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'noTelp' => $request->noTelp,
            'jenisKelamin' => $request->jenisKelamin,
            'jumlah' => $request->jumlah,
            
        ];
        
        mdlPembayaran::create($data);
        $data = mdlPembayaran::where('nama', $data['nama'])->where('alamat', $data['alamat'])->where('noTelp', $data['noTelp'])->first();
        // dd($data);
        return view('previewPdf',['data'=>$data])->with('success', 'Berhasil melakukan update data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = mdlPembayaran::where('id', $id)->first();
        return view('edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'noTelp' => 'required',
            'jenisKelamin' => 'required',
            'jumlah' => 'required',
            
        ], [
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'noTelp.required' => 'No.Telp wajib diisi',
            'jenisKelamin.required' => 'Jenis kelamin wajib diisi',
            'jumlah.required' => 'Jumlah wajib diisi',
            
            
        ]);
        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'noTelp' => $request->noTelp,
            'jenisKelamin' => $request->jenisKelamin,
            'jumlah' => $request->jumlah,
            
        ];
        mdlPembayaran::where('id', $id)->update($data);
        return redirect()->to('data_pembayaran')->with('success', 'Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        mdlPembayaran::where('id', $id)->delete();
        return redirect()->to('data_pembayaran')->with('success', 'Berhasil melakukan delete data');
    }
    public function get_resi()
    {
        $resi = '';
        $i = 0;
        for($i ; $i < 15 ; $i++){
            $resi .= random_int(0, 9);
        }
        // dd($resi);
        return $resi;
    }
}
