<?php
  
namespace App\Http\Controllers;
   
use App\Models\Barang;
use Illuminate\Http\Request;
  
class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['barangs'] = Post::orderBy('id','desc')->paginate(5);
    
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

        $path = $request->file('gambar')->store('public/uploads');

        $barang = new barang;

        $barang->nama_barang = $request->nama_barang;
        $barang->harga = $request->harga;
        $barang->gambar = $path;
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
        return view('admin.edit',compact('barangs'));
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

        if($request->hasFile('gambar')){
            $request->validate([
              'gambar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $path = $request->file('gambar')->store('public/uploads');
            $barang->gambar = $path;
        }

        $barang->nama_barang = $request->nama_barang;
        $barang->harga = $request->harga;
        $barang->image = $path;
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
    public function destroy(Barang $barang)
    {
        $post->delete();
    
        return redirect()->route('admin.index')
                        ->with('success','Post has been deleted successfully');
    }
}