<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pengelola.dashboard');
    }
}
