<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profil.index');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|max:20',
            'alamat' => 'nullable|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // upload foto
        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            $filename = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/profil'), $filename);

            $user->foto = $filename;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->alamat = $request->alamat;

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed'
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password)) {

            return back()->with('error', 'Password lama salah');
        }

        $user->password = Hash::make($request->password_baru);

        $user->save();

        return back()->with('success', 'Password berhasil diubah');
    }
}