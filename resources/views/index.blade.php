@extends('tamplate')
<!-- START DATA -->
@section('konten')

<div class="d-flex w-75 justify-content-beatween my-5" align="center">

    <div class="card w-50 bg-primary text-white mx-3">
        <h1 style="text-align: center;">Jumlah Donatur:</h1>
        <h1 style="text-align: center;">{{$statistik[0]->jml_donatur}}</h1>
    </div>
    <div class="card w-50 bg-success text-white mx-3">
        <h1 style="text-align: center;">Yang telah terkumpul</h1>
        <h1 style="text-align: center;">Rp.{{$statistik[0]->jml_uang}},</h1>
    </div>
</div>

<div class="my-3 p-3 bg-body rounded shadow-sm">
    <!-- FORM PENCARIAN -->
    <div class="pb-3">
        <form class="d-flex" action="{{ url('data_pembayaran') }}" method="get">
            <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
            <button class="btn btn-secondary" type="submit">Cari</button>
        </form>
    </div>

    <!-- TOMBOL TAMBAH DATA -->
    <div class="pb-3">
        <a href='{{ url('data_pembayaran/create') }}' class="btn btn-primary">+ Tambah Data</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-3">Nama</th>
                <th class="col-md-4">Alamat</th>
                <th class="col-md-2">No.Telp</th>
                <th class="col-md-2">Jenis Kelamin</th>
                <th class="col-md-3">Jumlah</th>
                <th class="col-md-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = $data->firstItem() ?>
            @foreach ($data as $item)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->noTelp }}</td>
                <td>{{ $item->jenisKelamin }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>

                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Dropdown button
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href='{{ url('data_pembayaran/'.$item->id.'/edit') }}'>Edit</a>
                          <form onsubmit="return confirm('Yakin akan menghapus data?')" class='d-inline' action="{{ url('data_pembayaran/'.$item->id) }}" method="post">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" name="submit" class="dropdown-item">Delete</button>
                                              </form>
                      
                          <a class="dropdown-item" href='{{ url('cetak-pdf/'.$item->id) }}'>Print</a>
                          <a class="dropdown-item" href='{{ url('#'.$item->id) }}'>Detail</a>
                        </div>
                      </div>
                      
                </td>
            </tr>
            <?php $i++ ?>
            @endforeach
        </tbody>
    </table>
    {{ $data->withQueryString()->links() }}
</div>
<!-- AKHIR DATA -->
@endsection

