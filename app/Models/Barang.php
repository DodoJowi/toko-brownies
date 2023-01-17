<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table ='barangs';
    protected $primaryKey = 'id';
    protected $fillable = array('nama_barang','harga','gambar','stok','keterangan','created_at','updated_at');
    
    use HasFactory;

    public function pesanan_detail(){
        return $this->hasMany('App\Models\PesananDetail','barang_id','id');
    }

    
}
