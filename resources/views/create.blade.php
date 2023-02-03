@extends('tamplate')
<!-- START FORM -->
@section('konten')


<div class="card  my-3  bg-body rounded shadow-sm ">
    <form action='{{ url('dt-pembayaran') }}' method='POST' enctype="multipart/form-data">
        @csrf
        <h5 class="card-header">Tambah data</h5>
        <div class="card-body">
            <div class=" mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10 input-group-sm">
                    <input type="text" class="form-control" name='nama' id="nama">
                    {!! $errors->first('nama', '<div class="error-block">:message *</div>') !!}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10 input-group-sm">
                    <input type="text" class="form-control" name='alamat' id="alamat">
                    {!! $errors->first('alamat', '<div class="error-block">:message *</div>') !!}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="noTelp" class="col-sm-2 col-form-label">No.Telp</label>
                <div class="col-sm-10 input-group-sm">
                    <input type="number" class="form-control" name='noTelp' id="noTelp">
                    {!! $errors->first('noTelp', '<div class="error-block">:message *</div>') !!}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jenisKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10 input-group-sm">
                    <select class="form-select form-select-sm" name="jenisKelamin" aria-label="Default select example">
                        <option value="" selected>Pilih Jenis Kelamin</option>
                        <option value="L">Laki- laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    {!! $errors->first('jenisKelamin', '<div class="error-block">:message *</div>') !!}
                    <!-- <input type="text" class="form-control" name='jenisKelamin' value="{{ Session::get('jenisKelamin') }}" id="jenisKelamin"> -->
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10 input-group-sm">
                    <input type="number" class="form-control" name='jumlah' id="jumlah">
                    {!! $errors->first('jumlah', '<div class="error-block">:message *</div>') !!}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="img" class="col-sm-2 col-form-label">Bukti</label>
                <div class="col-sm-10 input-group-sm">
                    <input type="file" class="form-control" name='img' id="img">
                    {!! $errors->first('img', '<div class="error-block">:message *</div>') !!}
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-end">
                <!-- <label for="simpan" class="col-sm-2 col-form-label"></label> -->
                <div class="align-self-end">
                    <a href='{{ url('dt-pembayaran') }}' class="btn btn-sm btn-secondary">
                        Batal</a>
                    <button type="submit" class="btn btn-sm btn-primary" name="submit">SIMPAN</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- AKHIR FORM -->
@endsection
