<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    public function run()
    {
        Petugas::create([
            'name' => 'Petugas Admin',
            'email' => 'petugas@example.com',
            'password' => Hash::make('password123'),  // hash password di sini
        ]);
    }
}
