<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class SupportPemilihanController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user')); // <-- WAJIB BEGITU
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = Auth::user();

        $folder = public_path('img/profile');
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        if ($user->fotoProfil && file_exists($folder . '/' . $user->fotoProfil)) {
            unlink($folder . '/' . $user->fotoProfil);
        }

        $file = $request->file('foto');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move($folder, $fileName);

        $user->fotoProfil = $fileName;
        $user->save();

        return redirect()->route('profile')->with('success', 'Foto berhasil diperbarui!');
    }
}
