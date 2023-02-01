<?php

namespace App\Http\Controllers;

use DB;

use App\Models\mdlPembayaran;
use Exception;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class ctrlPembayaran extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {

        $katakunci = $request->katakunci;
        $jumlahbaris = 2;
        if (strlen($katakunci)) {
            $data = mdlPembayaran::where('id', 'like', "%$katakunci%")
                ->orWhere('nama', 'like', "%$katakunci%")
                ->orWhere('alamat', 'like', "%$katakunci%")
                ->orWhere('noTelp', 'like', "%$katakunci%")
                ->orWhere('jenisKelamin', 'like', "%$katakunci%")
                ->orWhere('jumlah', 'like', "%$katakunci%")
                ->paginate($jumlahbaris);
        } else {
            $data = mdlPembayaran::orderBy('id', 'asc')->paginate($jumlahbaris);
        }
        // dd($data);
        $statistik = FacadesDB::select("CALL get_statistik()");
        return view('index', [
            'data' => $data,
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
        $data = [
            'resi' => strval($this->get_resi()),
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
        return view('previewPdf', ['data' => $data])->with('success', 'Berhasil melakukan update data');
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
        $dt = mdlPembayaran::where('id', $id)->first();
        // dd($dt->img);
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
            'img' => $dt->img != null ? '' : 'required|mimes:jpg,jpeg,png|max:2048',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->back()->withErrors($validator->errors());
        }
        $nameFile = '';
        if ($dt->img != null) {
            $nameFile = $dt->img;
        } else {
            $ext = pathinfo($request->file('img')->getClientOriginalName(), PATHINFO_EXTENSION);
            $fileName = 'bukti_' . $request->nama . '_' . date('d-m-Y') . '.' . $ext;
            $nameFile = $fileName;
            $path = public_path() . '/storage';
            $request->file('img')->move($path, $nameFile);
        };
        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'noTelp' => $request->noTelp,
            'jenisKelamin' => $request->jenisKelamin,
            'jumlah' => $request->jumlah,
            'img' => $nameFile,
        ];
        mdlPembayaran::where('id', $id)->update($data);
        return redirect()->to('dt-pembayaran')->with('success', 'Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $data = mdlPembayaran::where('id', $id)->first();
        unlink(public_path() . '\storage/' . $data->img);
        // dd($data->img);
        $data->delete();
        return redirect()->to('dt-pembayaran')->with('success', 'Berhasil melakukan delete data');
    }
    public function get_resi()
    {
        $resi = '';
        $i = 0;
        for ($i; $i < 15; $i++) {
            $resi .= random_int(0, 9);
        }
        // dd($resi);
        return $resi;
    }
    public function deleteimage($id)
    {
        try {
            $data = mdlPembayaran::where('id', $id)->update(['img' => '']);
            unlink(public_path() . '\storage/' . $data->img);
            return redirect()->back()->withErrors(['img', 'Berhasil menghapus gambar']);
        } catch (Exception $er) {
            return redirect()->back()->withErrors(['img', $er->getMessage()]);
        }
        // $data->delete();

    }
}
