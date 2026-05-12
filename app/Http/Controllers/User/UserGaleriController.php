<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use App\Models\Galeri;
use App\Models\Tiket;

class UserGaleriController extends Controller
{
    public function index()
    {
        $heros = Hero::all();
        $galeri = Galeri::latest()->get(); // Ambil semua data galeri dari database
        $tikets = Tiket::all();
        return view('welcome', compact('galeri', 'tikets', 'heros')); // Kirim variabel $galeri ke view 'welcome.blade.php'
    }
}
