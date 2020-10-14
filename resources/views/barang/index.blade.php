@extends('master')

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">Etalase</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card-columns">
            @foreach($barang as $ele)
                <div class="card">
                    <img class="card-img-top" src="{{ asset('storage/'.$ele->gambar) }}" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">{{ $ele->namaBarang }}</h5>
                    <p class="card-text">{{ $ele->keterangan }}</p>
                    <p class="card-text">
                        <a href="{{ route('editBarang', ['id' => $ele->idBarang]) }}" class="btn btn-warning">Edit</a>
                        <a href="javascript.void(0)" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('deleteBarang{{$ele->idBarang}}').submit();">Delete</a>
                        <form method="POST" action="{{ route('deleteBarang', ['id' => $ele->idBarang]) }}" id="deleteBarang{{ $ele->idBarang }}">
                            @csrf
                            @method('delete')
                        </form>
                    </p>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection