<?php 
namespace App\Http\Controllers;

// panggil produk model
use App\Produk;
use Illuminate\Http\Request;




class ProdukController extends Controller
{
    public function create (Request $request)
    {
        // ambil data dari form dan lakukan filtering
        $this->validate($request, [
            'nama' => 'required|string',
            'harga' => 'required|integer',
            'warna' => 'required|string',
            'kondisi' => 'required|in:Baru,Lama',
            'deskripsi' => 'string|nullable',
        ]);
        
        $produk = Produk::create($request->all());

        // kita kasih return berupa json dari data tadi
        return response()->json($produk);
    }
}

