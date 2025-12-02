<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\WishlistPackage;

class PackageController extends Controller
{
    /**
     * Helper method untuk get saved package IDs
     */
    private function getSavedPackageIds()
    {
        if (Auth::check()) {
            return WishlistPackage::where('userID', Auth::id())
                                 ->pluck('packageID')
                                 ->toArray();
        }
        return [];
    }

    /**
     * Menampilkan halaman paket Netflix
     */
    public function showNetflix()
    {
        $packages = DB::table('package')
            ->where('serviceName', 'Netflix')
            ->orderByRaw("FIELD(packageType, 'Hourly', 'Daily', 'Monthly')")
            ->orderBy('durasiPackage', 'asc')
            ->get();

        $groupedPackages = $packages->groupBy('packageType');

        // Get saved package IDs
        $savedPackageIds = $this->getSavedPackageIds();

        return view('packagenetflix', [
            'packages' => $groupedPackages,
            'serviceName' => 'Netflix',
            'serviceDescription' => 'Nikmati pengalaman menonton tanpa batas dengan paket Netflix khusus. Dapatkan akses ke ribuan film, serial, dan dokumenter terbaik di dunia. Tidak ada iklan, tidak ada gangguan, hanya hiburan berkualitas untuk setiap momen.',
            'savedPackageIds' => $savedPackageIds
        ]);
    }

    public function showPrime()
    {
        $packages = DB::table('package')
            ->where('serviceName', 'Prime Video')
            ->orderByRaw("FIELD(packageType, 'Hourly', 'Daily', 'Monthly')")
            ->orderBy('durasiPackage', 'asc')
            ->get();

        $groupedPackages = $packages->groupBy('packageType');

        // Get saved package IDs
        $savedPackageIds = $this->getSavedPackageIds();

        return view('packageprime', [
            'packages' => $groupedPackages,
            'serviceName' => 'Prime Video',
            'serviceDescription' => 'Nikmati pengalaman menonton tanpa batas dengan paket Prime Video khusus. Dapatkan akses ke ribuan film, serial, dan dokumenter terbaik di dunia. Tidak ada iklan, tidak ada gangguan, hanya hiburan berkualitas untuk setiap momen.',
            'savedPackageIds' => $savedPackageIds
        ]);
    }

    public function showViu()
    {
        $packages = DB::table('package')
            ->where('serviceName', 'Viu')
            ->orderByRaw("FIELD(packageType, 'Hourly', 'Daily', 'Monthly')")
            ->orderBy('durasiPackage', 'asc')
            ->get();

        $groupedPackages = $packages->groupBy('packageType');

        // Get saved package IDs
        $savedPackageIds = $this->getSavedPackageIds();

        return view('packageviu', [
            'packages' => $groupedPackages,
            'serviceName' => 'Viu',
            'serviceDescription' => 'Nikmati pengalaman menonton tanpa batas dengan paket Viu khusus. Dapatkan akses ke ribuan film, serial, dan dokumenter terbaik di dunia. Tidak ada iklan, tidak ada gangguan, hanya hiburan berkualitas untuk setiap momen.',
            'savedPackageIds' => $savedPackageIds
        ]);
    }

    /**
     * FIXED: Menampilkan halaman paket untuk service lainnya (generic)
     * Sekarang return view yang sesuai dengan service
     */
    public function showPackage($service)
    {
        // Capitalize first letter of each word
        $serviceName = ucwords(str_replace('-', ' ', $service));

        // Ambil semua paket dari database berdasarkan service name
        $packages = DB::table('package')
            ->where('serviceName', $serviceName)
            ->orderByRaw("FIELD(packageType, 'Hourly', 'Daily', 'Monthly')")
            ->orderBy('durasiPackage', 'asc')
            ->get();

        // Jika tidak ada paket ditemukan
        if ($packages->isEmpty()) {
            abort(404, 'Service not found');
        }

        // Kelompokkan paket berdasarkan tipe
        $groupedPackages = $packages->groupBy('packageType');

        // Get saved package IDs
        $savedPackageIds = $this->getSavedPackageIds();

        // FIXED: Mapping service name ke view file yang sesuai
        $viewMap = [
            'Netflix' => 'packagenetflix',
            'Prime Video' => 'packageprime',
            'Viu' => 'packageviu',
            'Vidio' => 'packagevidio',  // Jika ada
            'Hotstar' => 'packagehotstar',  // Jika ada
        ];

        $descriptions = [
            'Netflix' => 'Nikmati pengalaman menonton tanpa batas dengan paket Netflix khusus. Dapatkan akses ke ribuan film, serial, dan dokumenter terbaik di dunia.',
            'Prime Video' => 'Akses ribuan film dan series eksklusif dengan Amazon Prime Video. Tonton konten original dan blockbuster terbaik.',
            'Viu' => 'Tonton drama Asia terbaik dan konten eksklusif di Viu. Streaming tanpa batas untuk hiburan Anda.',
            'Vidio' => 'Streaming konten lokal dan internasional terbaik di Vidio. Hiburan untuk seluruh keluarga.',
            'Hotstar' => 'Nikmati konten premium dari Disney, Marvel, Star Wars, dan lainnya di Disney+ Hotstar.',
        ];

        // FIXED: Gunakan view yang sesuai, fallback ke packagenetflix jika tidak ada
        $viewName = $viewMap[$serviceName] ?? 'packagenetflix';

        return view($viewName, [
            'packages' => $groupedPackages,
            'serviceName' => $serviceName,
            'serviceDescription' => $descriptions[$serviceName] ?? 'Nikmati streaming berkualitas tinggi.',
            'savedPackageIds' => $savedPackageIds
        ]);
    }
}