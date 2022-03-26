<?php 
namespace App\Http\Controllers;

// panggil produk model
use App\Produk;
use Illuminate\Http\Request;


class ProdukController extends Controller
{
    public function create (Request $request)
    {
        // ambil data dari form
        $data = $request->all();
        $produk = Produk::create($data);

        // kita kasih return berupa json dari data tadi
        return response()->json($produk);
    }
}

