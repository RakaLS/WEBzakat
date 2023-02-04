@extends('tamplate')
<!-- START FORM -->
@section('konten')

<form action='{{ url('dt-pembayaran/'.$data->id) }}' method='post' enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card my-3 bg-body rounded shadow-sm">
        <h5 class="card-header">Edit Data</h5>
        <div class="card-body">
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10 input-group-sm">
                    <input type="text" class="form-control" name='nama' value="{{ $data->nama }}" id="nama">
                    {!! $errors->first('nama', '<div class="error-block">:message *</div>') !!}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10 input-group-sm">
                    <input type="text" class="form-control" name='alamat' value="{{ $data->alamat  }}" id="alamat">
                    {!! $errors->first('alamat', '<div class="error-block">:message *</div>') !!}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="noTelp" class="col-sm-2 col-form-label">No.Telp</label>
                <div class="col-sm-10 input-group-sm">
                    <input type="number" class="form-control" name='noTelp' value="{{ $data->noTelp  }}" id="noTelp">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jenisKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <!-- <div class="col-sm-10 input-group-sm">
                <input type="text" class="form-control" name='jenisKelamin' value="{{ $data->jenisKelamin }}" id="jenisKelamin">
            </div> -->
                <div class="col-sm-10 input-group-sm input-group-sm">
                    <select class="form-select form-select-sm" name="jenisKelamin" aria-label="Default select example">
                        <!-- <option selected>Jenis Kelamin</option> -->
                        <option value="" {{ $data->jenisKelamin ==""? 'selected':'' }}>Pilih Jenis Kelamin</option>
                        <option value="L" {{ $data->jenisKelamin =="L"? 'selected':'' }}>Laki- laki</option>
                        <option value="P" {{ $data->jenisKelamin =="P"? 'selected':'' }}>Perempuan</option>
                    </select>
                    {!! $errors->first('alamat', '<div class="error-block">:message *</div>') !!}
                    <!-- <input type="text" class="form-control" name='jenisKelamin' value="{{ Session::get('jenisKelamin') }}" id="jenisKelamin"> -->
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10 input-group-sm">
                    <input type="number" class="form-control" name='jumlah' value="{{ $data->jumlah }}" id="jumlah">
                    {!! $errors->first('alamat', '<div class="error-block">:message *</div>') !!}
                </div>
            </div>
            <div class="mb-3 row">
                <label for="img" class="col-sm-2 col-form-label">Bukti</label>
                <div class="col-sm-10 input-group-sm">
                    @if($data->img != null)
                    <span>

                        <p> :&nbsp; {{ $data->img }} &nbsp;<a href="{{ url('delete-image/'.$data->id) }}" aria-label="delete-image" data-toggle="tooltip" title="Delete"><i class="bi bi-trash3-fill text-danger"></i></a></p> 
                        {!! $errors->first('img', '<div class="error-block">:message *</div>') !!}
                    </span>
                    @else
                    <input type="file" class="form-control" name='img' value="{{ $data->img }}" id="img">
                    {!! $errors->first('img', '<div class="error-block">:message *</div>') !!}
                    @endif
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-end">
                <div class="align-self-end">
                    <a href='{{ url('dt-pembayaran') }}' class="btn btn-sm btn-secondary"> Batal</a>
                    <button type="submit" class="btn btn-sm btn-primary" name="submit">SIMPAN</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- AKHIR FORM -->
<script>
    // Get a reference to our file input
    const fileInput = document.querySelector('input[type="file"]');

    // Create a new File object
    const myFile = new File(['Hello World!'], "{{ $data->img != null? $data->img : 'No File Chosen'}}", {
        type: 'text/plain',
        lastModified: new Date(),
    });

    // Now let's create a DataTransfer to get a FileList
    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(myFile);
    fileInput.files = dataTransfer.files;
</script>
@endsection