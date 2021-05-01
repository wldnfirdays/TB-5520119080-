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
}
