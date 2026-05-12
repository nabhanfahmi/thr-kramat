<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $pemesanans = $user->pemesanans()
        ->with('tiket')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('user.dashboard', compact('user', 'pemesanans'));
    }
}
