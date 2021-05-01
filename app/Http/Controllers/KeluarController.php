<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Keluar;
use Illuminate\Support\Facades\Storage;

class KeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $keluars = keluar::all();
        return view('keluar', compact('user', 'keluars'));
    }
    public function submit_keluar(Request $req){
        $keluar = new Keluar;

        $keluar->name = $req->get('name');
        $keluar->description = $req->get('description');

        $keluar->save();

        $notification = array(
            'message' => 'Data Merek berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('keluar')->with($notification);
    }


    // ajax prosess
    public function getDataKeluar($id)
    {
        $keluar = Keluar::find($id);

        return response()->json($keluar);
    }

    // update keluar
    public function update_keluar(Request $req)
    {
        $keluar = Keluar::find($req->get('id'));

        $keluar->name = $req->get('name');
        $keluar->description = $req->get('description');

        $keluar->save();

        $notification = array(
            'message' => 'Data Merek berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('keluar')->with($notification);
    }

    public function delete_keluar(Request $req)
    {
        $keluar = Keluar::find($req->get('id'));

        $keluar->delete();

        $notification = array(
            'message' => 'Data Merek berhasil dihapus',
            'alert-type' => 'warning'
        );

        return redirect()->route('keluar')->with($notification);
    }
}
