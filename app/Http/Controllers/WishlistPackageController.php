<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\WishlistPackage;
use Illuminate\Support\Facades\Auth;

class WishlistPackageController extends Controller
{
    /**
     * Menampilkan halaman Saved Package
     * Route: GET /saved-package
     */
    public function index()
    {
        $userID = Auth::id();
        
        // Ambil semua wishlist package milik user dengan relasi package
        $savedPackages = WishlistPackage::where('userID', $userID)
            ->with('package')
            ->orderBy('wishlistID', 'desc')
            ->get();

        return view('saved-package', compact('savedPackages'));
    }

    /**
     * Menyimpan paket ke wishlist (Klik tombol Saved)
     * Route: POST /saved-package/store
     */
    public function store(Request $request)
    {
        $request->validate([
            'packageID' => 'required|exists:Package,packageID'
        ]);

        $userID = Auth::id();
        $packageID = $request->input('packageID');

        // Cek apakah sudah disimpan sebelumnya
        $exists = WishlistPackage::where('userID', $userID)
            ->where('packageID', $packageID)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Paket sudah ada di wishlist Anda'
            ], 409);
        }

        // Simpan ke database
        WishlistPackage::create([
            'userID' => $userID,
            'packageID' => $packageID
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Paket berhasil disimpan ke wishlist!'
        ]);
    }

    /**
     * Menghapus paket dari wishlist (Unsave)
     * Route: DELETE /saved-package/remove
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'wishlistID' => 'required|exists:WishlistPackage,wishlistID'
        ]);

        $userID = Auth::id();
        $wishlistID = $request->input('wishlistID');

        // Hapus dari wishlist, pastikan milik user yang login
        $deleted = WishlistPackage::where('wishlistID', $wishlistID)
            ->where('userID', $userID)
            ->delete();

        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Paket berhasil dihapus dari wishlist'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus paket'
        ], 400);
    }

    /**
     * Toggle save/unsave paket (untuk tombol bookmark)
     * Route: POST /saved-package/toggle
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'packageID' => 'required|exists:Package,packageID'
        ]);

        $userID = Auth::id();
        $packageID = $request->input('packageID');

        // Cek apakah sudah disimpan
        $wishlist = WishlistPackage::where('userID', $userID)
            ->where('packageID', $packageID)
            ->first();

        if ($wishlist) {
            // Jika sudah ada, hapus (unsave)
            $wishlist->delete();
            return response()->json([
                'success' => true,
                'action' => 'removed',
                'message' => 'Paket dihapus dari wishlist'
            ]);
        } else {
            // Jika belum ada, simpan (save)
            WishlistPackage::create([
                'userID' => $userID,
                'packageID' => $packageID
            ]);
            return response()->json([
                'success' => true,
                'action' => 'saved',
                'message' => 'Paket disimpan ke wishlist'
            ]);
        }
    }

    /**
     * Cek apakah paket sudah disimpan (untuk update UI)
     * Route: GET /saved-package/check/{packageID}
     */
    public function checkStatus($packageID)
    {
        $userID = Auth::id();
        
        $isSaved = WishlistPackage::where('userID', $userID)
            ->where('packageID', $packageID)
            ->exists();

        return response()->json([
            'isSaved' => $isSaved
        ]);
    }
}