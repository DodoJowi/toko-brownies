@extends('upload')

@section('content')
<div class="container mt-2">
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('admin.create') }}"> Create New Post</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Nama Produk</th>
            <th>harga</th>
            <th>stok</th>
            <th>keterangan</th>
            <th width="240px">Action</th>
        </tr>
        @foreach ($barangs as $barang)
        <tr>
            <td>{{ $barang->id }}</td>
            <td><img src="{{url('uploads')}}/{{ $barang->gambar}}" height="75" width="75" alt="" /></td>
            <td>{{ $barang->nama_barang }}</td>
            <td>{{ $barang->harga }}</td>
            <td>{{ $barang->stok }}</td>
            <td>{{ $barang->keterangan }}</td>
            <td>
                <form action="{{ route('admin.destroy',$barang->id) }}" method="POST">
    
                    <a class="btn btn-primary" href="{{ route('admin.edit',$barang->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $barangs->links() !!}
    @endsection
