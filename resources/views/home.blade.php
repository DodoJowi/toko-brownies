@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <img src="{{url('img/logojo.png')}}" width="300" class="gambar rounded d-block mx-auto " alt="">
        </div>
        @foreach($barangs as $barang)
        <div class="col-md-4 mt-2">
            <div class="card">
                <img src="{{url('uploads')}}/{{$barang->gambar }}" class="card-img-top" height="220" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $barang->nama_barang}}</h5>
                    <p class="card-text">
                        <strong> Harga :</strong> Rp. {{number_format ($barang->harga)}} <br>
                        <strong> Stok :</strong> {{ $barang->stok}} <br>
                        <hr>
                        <strong> Keterangan :</strong> <br>
                        {{ $barang->keterangan}}
                    </p>
                    <a href="{{url('pesan')}}/{{ $barang->id}}" class="btn btn-primary "><i class="fa fa-shopping-cart me-2"></i>Pesan</a>
                </div> 
            </div>

        </div>
        @endforeach
    </div>
</div>
@endsection
