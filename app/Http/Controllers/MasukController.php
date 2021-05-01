<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Masuk;
use Illuminate\Support\Facades\Storage;

class MasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $masuks = masuk::all();
        return view('masuk', compact('user', 'masuks'));
    }

    public function submit_masuk(Request $req){
        $masuk = new Masuk;

        $masuk->name = $req->get('name');
        $masuk->description = $req->get('description');

        $masuk->save();

        $notification = array(
            'message' => 'Data Merek berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('masuk')->with($notification);
    }


    // ajax prosess
    public function getDataMasuk($id)
    {
        $masuk = Masuk::find($id);

        return response()->json($masuk);
    }

    // update masuk
    public function update_masuk(Request $req)
    {
        $masuk = Masuk::find($req->get('id'));

        $masuk->name = $req->get('name');
        $masuk->description = $req->get('description');

        $masuk->save();

        $notification = array(
            'message' => 'Data Merek berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('masuk')->with($notification);
    }

    public function delete_masuk(Request $req)
    {
        $masuk = masuk::find($req->get('id'));

        $masuk->delete();

        $notification = array(
            'message' => 'Data Merek berhasil dihapus',
            'alert-type' => 'warning'
        );

        return redirect()->route('masuk')->with($notification);
    }
}

