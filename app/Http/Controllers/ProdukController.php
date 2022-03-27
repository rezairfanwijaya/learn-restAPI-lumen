<?php 
namespace App\Http\Controllers;

// panggil produk model
use App\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // function untuk post data 
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


    // function show data
    public function index(){
        $produk = Produk::all();
        return response()->json($produk);
    }


    // function untuk update data
    public function update(Request $request, $id){
        // cari produk berdasarkan id
        $produk = Produk::findOrFail($id);

        // filtering data
        $this->validate($request, [
            'nama' => 'string',
            'harga' => 'integer',
            'warna' => 'string',
            'kondisi' => 'in:Baru,Lama',
            'deskripsi' => 'string|nullable',
        ]);

        // update data produk berdasarkan id
        $produk->update($request->all());

        // kasih return berupa json dari data tadi
        return response()->json($produk);
    }

}

