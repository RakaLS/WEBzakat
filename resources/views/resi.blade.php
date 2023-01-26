@extends('tamplate')

@section('konten')    
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <!-- FORM PENCARIAN -->
    
    <table class="table table-striped">
        <thead>
            <td>
                <th class="col-md-1">No </th>
                <th class="col-md-3">Nama</th>
                <th class="col-md-4">Alamat</th>
                <th class="col-md-2">No.Telp</th>
				<th class="col-md-2">Jenis Kelamin</th>
				<th class="col-md-3">Jumlah</th>
                <th class="col-md-2">Aksi</th>
            </td>
        </thead>
        <tbody>
            <?php $i = $data->firstItem() ?>
            @foreach ($data as $item)
            <tr>
                
                <td>
                    <a href='{{ url('data_pembayaran/'.$item->id.'/edit') }}' class="btn btn-warning btn-sm">Edit</a>
                    <form onsubmit="return confirm('Yakin akan menghapus data?')" class='d-inline' action="{{ url('data_pembayaran/'.$item->id) }}" method="post">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                    </form>
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
    