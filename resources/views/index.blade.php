@extends('tamplate')
<!-- START DATA -->
@section('konten')
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

                    <div class="d-flex flex-row justify-content-center">
                        <a href='{{ url('data_pembayaran/'.$item->id.'/edit') }}' class="btn btn-warning btn-sm">Edit</a>
                        <form onsubmit="return confirm('Yakin akan menghapus data?')" class='d-inline' action="{{ url('data_pembayaran/'.$item->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="submit" class="btn btn-danger btn-sm mx-1">Delete</button>
                        </form>
                        <a href='{{ url('cetak-pdf/'.$item->id) }}' class="btn btn-success btn-sm">Print</a>
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