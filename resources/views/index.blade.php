@extends('tamplate')
<!-- START DATA -->
@section('konten')
<script>
    // Import library phpqrcode
require_once 'phpqrcode/qrlib.php';

// Get data from MySQL
$isi = DB::table('users')->select('id', 'name', 'address')->get();

// Generate QR code and save as SVG
foreach ($isi as $d) {
    // Define filename based on name
    $filename = 'C:\xampp\htdocs\landingPage\qr-code\\' . $d->nama . '.svg';
    
    // Generate QR code with data and save as SVG
    QRcode::svg($d->id . ' ' . $d->resi . ' ' . $d->nama . ' ' . $d->alamat . ' ' . $d->noTelp . ' ' . $d->jenisKelamin . ' ' . $d->jumlah, $filename);
}

// Download file when button is clicked
function downloadFile($filename) {
    header('Content-Type: application/svg+xml');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    readfile('C:\xampp\htdocs\landingPage\qr-code\\' . $filename);
}

</script>
<div class="d-flex flex-row w-100 justify-content-center my-5" align="center">

    <div class=" align-self-center d-flex flex-row">
        <div class="col-md-5 card shadow bg-primary text-white mx-3">
            <h5 class="card-header" style="text-align: center;">Jumlah Donatur</h5>
            <h5 class="card-body align-middle" style="text-align: center;">{{$statistik[0]->jml_donatur}}&nbsp;Orang</h5>
        </div>
        <div class="col-md-7 card shadow bg-success text-white mx-3">
            <h5 class="card-header" style="text-align: center;">Jumlah Uang</h5>
            <h5 class="card-body align-middle" style="text-align: center; padding-left:3rem;padding-right:3rem;">Rp.&nbsp; {{number_format($statistik[0]->jml_uang)}}</h5>
        </div>
    </div>
</div>

<div class="my-3 p-3 bg-body rounded shadow-sm">
    <!-- FORM PENCARIAN -->
    <div class="pb-3">
        <form class="d-flex" action="{{ url('dt-pembayaran') }}" method="get">
            <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
            <button class="btn btn-secondary" type="submit">Cari</button>
        </form>
    </div>

    <!-- TOMBOL TAMBAH DATA -->
    <div class="pb-3">
        <a href='{{ url('dt-pembayaran/create') }}' class="btn btn-primary">+ Tambah Data</a>
    </div>

    <div id="bungkus-table">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md">Resi</th>
                    <th class="col-md-2">Nama</th>
                    <th class="col-md-3">Alamat</th>
                    <th class="col-md">No.Telp</th>
                    <th class="col-md-1 text-center">Gender</th>
                    <th class="col-md-2">Jumlah</th>
                    <th class="col-md-1 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php

                use Illuminate\Support\Facades\URL;

                $i = $data->firstItem() ?>
                @foreach ($data as $item)

                <tr>

                    <td>{{$i}}</td>
                    <td>{{ $item->resi }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->noTelp }}</td>
                    <td class="text-center">{{ $item->jenisKelamin }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-outline-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Aksi
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ url('dt-pembayaran/'.$item->id.'/edit') }}">Edit</a></li>
                                <li>

                                    <form id="delete-form-{{$item->id}}" class='' action="{{ url('dt-pembayaran/'.$item->id) }}" method="post">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}

                                        <a href="#" class="dropdown-item" style="text-decoration: none; color:black;" onclick="document.getElementById('delete-form-{{$item->id}}').submit(); return false;">Delete</a>
                                    </form>
                                </li>
                                <li><a class="dropdown-item" href="#" type="button" data-bs-toggle="modal" data-bs-target="#modal-{{$item->id}}">Details</a>

                                </li>
                                <li></li>
                                <li><a class="dropdown-item" href="{{ url('preview-pdf/'.$item->id) }}" >Preview</a></li>
                                <li><a class="dropdown-item" href="{{ url('cetak-pdf/'.$item->id) }}">Print</a></li>
                                <li><a class="dropdown-item" onclick="downloadFile('{{ $filename }}')">Save QR Code</a></li>
                            </ul>

                        </div>
                    </td>
                </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="{{$data->links()->paginator->path().'?page=1'}}" aria-label="Previous">
                        << </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="{{$data->links()->paginator->path().'?page='.$data->links()->paginator->currentPage()-1}}" aria-label="Previous">
                        < </a>
                </li>
                @foreach($data->links()->elements[0] as $key => $val)
                @if($data->links()->paginator->currentPage() == $key)
                <li class="page-item active"><a class="page-link" href="{{$val}}">{{$key}}</a></li>
                @else
                <li class="page-item"><a class="page-link" href="{{$val}}">{{$key}}</a></li>
                @endif
                @endforeach
                <li class="page-item">
                    <a class="page-link" href="{{$data->links()->paginator->path().'?page='.$data->links()->paginator->currentPage()+1}}" aria-label="Next">
                        >
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="{{$data->links()->paginator->path().'?page='.$data->links()->paginator->lastPage()}}" aria-label="Next">
                        >>
                    </a>
                </li>
            </ul>
        </nav>

    </div>
</div>
<!-- AKHIR DATA -->

<!-- modal details -->
@foreach ($data as $item)
<div class="modal fade" id="modal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Details</h5>
                <button type="button" class="btn-close abtn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row my-3">
                    <div class="col-md-2">Resi</div>
                    <div class="col-md">:&nbsp; {{$item->resi}}</div>
                </div>
                <div class="row my-3">
                    <div class="col-md-2">Nama</div>
                    <div class="col-md">:&nbsp; {{$item->nama}}</div>
                </div>
                <div class="row my-3">
                    <div class="col-md-2">Alamat</div>
                    <div class="col-md">:&nbsp; {{$item->alamat}}</div>
                </div>
                <div class="row my-3">
                    <div class="col-md-2">No Telp</div>
                    <div class="col-md">:&nbsp; {{$item->noTelp}}</div>
                </div>
                <div class="row my-3">
                    <div class="col-md-2">Jumlah</div>
                    <div class="col-md">:&nbsp; Rp.&nbsp; {{number_format($item->jumlah)}}</div>
                </div>
                <div class="row my-3">
                    <div class="col-md-2">Gender</div>
                    <div class="col-md">:&nbsp; {{$item->jenisKelamin == 'L' ? 'Laki - laki' : 'Perempuan' }}</div>
                </div>
                <div class="row my-3">
                    <div class="col-md-2">Bukti</div>
                    <div class="col-md">:&nbsp;
                        <!-- <img src="{{ url('storage/'.$item->img) }}" alt="">     -->
                        <a href="{{ url('storage/'.$item->img) }}" > Show Image</a>
                    </div>
                </div>

                <!-- <div class="d-flex justify-content center">
                    <div class="w-50">
                        <img src="{{asset('storage/'.'$item->img')}}" width="100%" alt="" srcset="">
                    </div>
                </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection