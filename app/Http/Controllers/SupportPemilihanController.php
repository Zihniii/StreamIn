<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SupportPemilihanController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function uploadForm()
    {
        $user = Auth::user();
        return view('profile-upload', compact('user'));
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = Auth::user();

        // Ambil file
        $file = $request->file('foto');
        
        // Generate nama file unik
        $fileName = time().'_'.$file->getClientOriginalName();
        
        // Simpan ke storage/app/public/profile
        $file->storeAs('public/profile', $fileName);

        // Simpan ke database pada kolom fotoProfil
        $user->fotoProfil = $fileName;
        $user->save();

        return redirect()->route('profile')->with('success', 'Foto profil berhasil diperbarui.');
    }
}
