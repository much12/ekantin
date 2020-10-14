@extends('master')

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">Edit Barang</li>
        </ol>
    </nav>
    <div>
        <form action="{{ route('updateBarang', ['id' => $barang->idBarang]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="nama" value="{{ $barang->namaBarang }}" required>
            <select name="kategori" id="" required>
                <option >-- Pilih Kategori --</option>
                <option value="makanan" {{ $barang->kategori == "makanan" ? "selected" : "" }}>makanan</option>
                <option value="minuman" {{ $barang->kategori == "minuman" ? "selected" : "" }}>minuman</option>
            </select>
            <input type="number" name="harga" value="{{ $barang->harga }}" required>
            <input type="number" name="stock" min="0" max="9999" value="{{ $barang->stock }}" required>
            <input type="file" name="gambar" accept="image/*" onchange="previewGambar(this)">
            <textarea name="keterangan" id="keterangan" cols="30" rows="10">{{ $barang->keterangan }}</textarea>
            <img src="{{ asset('/storage/'.$barang->gambar) }}" id="gambarBarang">
            <button type="submit">submit</button>
        </form>
    </div>
    <div>
        <ul>
            <li>{{ $errors->first('nama') }}</li>
            <li>{{ $errors->first('kategori') }}</li>
            <li>{{ $errors->first('harga') }}</li>
            <li>{{ $errors->first('stock') }}</li>
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