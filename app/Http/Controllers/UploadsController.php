<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class UploadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('upload');
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga'=>'required',
            'gambar' => 'required|gambar|mimes:png,jpg,jpeg',
            'stok' => 'required',
            'keterangan' => 'required',
        ]);
        $data = $request->file('gambar')->move(public_path('uploads'), $filename);
        $filename = $data->getClientOriginalName();
        $test = $data->storeAs('', $filename);
        $data = Barang::create([
            'nama_barang'=> $request->nama_barang,
            'harga'=> $request->harga,
            'gambar'=> $test,
            'stok'=> $request->stok,
            'keterangan'=>$request->keterangan,
        ]);

        return redirect('upload');
    }
}