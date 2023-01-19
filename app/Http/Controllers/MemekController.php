<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
class MemekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['barangs'] = Barang::orderBy('id','desc')->paginate(5);
    
        return view('admin.index', $data);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'stok' => 'required',
            'keterangan' => 'required',
        ]);

        $data = $request->file('gambar');
        $filename = time().'.'.$data->getClientOriginalName();
        $test =  $data->move(public_path('uploads'), $filename);
        $barang = new barang;

        $barang->nama_barang = $request->nama_barang;
        $barang->harga = $request->harga;
        $barang->gambar = $filename;
        $barang->stok = $request->stok;
        $barang->keterangan = $request->keterangan;

        $barang->save();

     
        return redirect()->route('admin.index')
                        ->with('success','Post has been created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        return view('admin.show',compact('barangs'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        return view('admin.edit',compact('barang'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'stok' => 'required',
            'keterangan' => 'required',
        ]);
        
        $barang = Barang::find($id);

        $data = $request->file('gambar');
        $filename = time().'.'.$data->getClientOriginalName();
        $test =  $data->move(public_path('uploads'), $filename);
        

        $barang->nama_barang = $request->nama_barang;
        $barang->harga = $request->harga;
        $barang->gambar = $filename;
        $barang->stok = $request->stok;
        $barang->keterangan = $request->keterangan;

        $barang->save();
    
        return redirect()->route('posts.index')
                        ->with('success','Post updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang, $id)
    {   
        $barang = Barang::find($id);
        $barang->delete();
        return redirect()->route('admin.index')
                        ->with('success','Post has been deleted successfully');
    }
}
