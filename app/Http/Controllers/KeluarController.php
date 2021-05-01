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
}
