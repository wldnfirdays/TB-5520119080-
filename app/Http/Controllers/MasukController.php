<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Masuk;
use PDF;

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
        
        return view('masuk', compact('masuks'));
    }

    public function print_masuk()
    {
        $masuks = masuk::all();
        $pdf = PDF::loadview('print_masuk', ['masuks' => $masuks]);
        return $pdf->download('Laporan_Barang_Masuk.pdf');
    }

}

