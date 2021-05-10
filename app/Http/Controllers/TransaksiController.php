<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $transaksis = Transaksi::all();
        $products = Product::all();
        return view('transaksi', compact('transaksis', 'products'));

    }

    public function submit_transaksi(Request $req){
        $transaksi = new Transaksi;

        $transaksi->id_product = $req->get('id_product');
        $transaksi->qty = $req->get('qty');
        

        $transaksi->save();

        $notification = array(
            'message' => 'Data Produk berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('transaksi')->with($notification);
    }
}
