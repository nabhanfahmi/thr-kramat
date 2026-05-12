<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Galeri; // atau model Berita kalau kamu pisah

class UserBeritaController extends Controller
{
    public function show($id)
    {
        $item = Galeri::findOrFail($id); // kalau berita jadi satu dengan galeri
        return view('user.berita.show', compact('item'));
    }
}