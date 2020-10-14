@extends('master')

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">Tambah Barang</li>
        </ol>
    </nav>
    <div>
        <form action="{{ route('storeBarang') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="nama" required>
            <select name="kategori" id="" required>
                <option >-- Pilih Kategori --</option>
                <option value="makanan">makanan</option>
                <option value="minuman">minuman</option>
            </select>
            <input type="number" name="harga" required>
            <input type="number" name="stock" min="0" max="9999" required>
            <input type="file" name="gambar" accept="image/*" onchange="previewGambar(this)">
            <textarea name="keterangan" id="" cols="30" rows="10"></textarea>
            <img src="" id="gambarBarang">
            <button type="submit">submit</button>
        </form>
    </div>
    <div>
        <ul>
            <li>{{ $errors->first('nama') }}</li>
            <li>{{ $errors->first('kategori') }}</li>
            <li>{{ $errors->first('harga') }}</li>
            <li>{{ $errors->first('stock') }}</li>
            <li>{{ $errors->first('keterangan') }}</li>
            <li>{{ $errors->first('gambar') }}</li>
        </ul>
    </div>
</div>
@endsection

@section('script')
<script>
    function previewGambar(e){
        var fileReader = new FileReader();
        fileReader.onload = (ele) => {
            var img = document.getElementById('gambarBarang');
            img.src = ele.target.result;
        }
        fileReader.readAsDataURL(e.files[0]);
    }
</script>
@endsection