@extends('tamplate')
<!-- START FORM -->
@section('konten')
<div class="conatiner d-flex justify-content-center py-3">
    <div class="card w-50">
        <h5 class="card-header">Details</h5>
        <div class="card-body">
            <div class="mb-3 row">
                <label for="nama" class="col-sm-3 col-form-label">Resi</label>
                <div class="col-sm-9">
                    <p>:&nbsp {{ $data->resi }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                    <p>:&nbsp {{ $data->nama  }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat"  class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                <p>:&nbsp {{ $data->alamat  }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="noTelp" class="col-sm-3 col-form-label">No.Telp</label>
                <div class="col-sm-9">
                <p>:&nbsp {{ $data->noTelp  }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jenisKelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-9">
                <p>:&nbsp {{ $data->jenisKelamin}}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                <div class="col-sm-9">
                <p>:&nbsp {{ $data->jumlah  }}</p>
                </div>
            </div>
            <div class="d-flex flex-row-reverse ">
                <a href="{{ url('cetak-pdf/'.$data->id) }}'" class="btn btn-success mx-1">Print</a>
                <a href="/dt-pembayaran" class="btn btn-secondary mx-1">Tidak</a>
            </div>
        </div>
    </div>
</div>
@endsection