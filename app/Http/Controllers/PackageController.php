<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\WishlistPackage;
use App\Models\Package;
use App\Models\UserSubscription;
use Carbon\Carbon;

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
    // Ubah slug (contoh: prime-video) menjadi Nama Normal (Prime Video)
    $serviceName = ucwords(str_replace('-', ' ', $service));

    // Ambil data dari tabel package
    $packages = DB::table('package')
        ->whereRaw('LOWER(TRIM(serviceName)) = ?', [strtolower($serviceName)])
        ->orderByRaw("FIELD(packageType, 'Hourly', 'Daily', 'Monthly')")
        ->get();

    if ($packages->isEmpty()) {
        abort(404, 'Layanan ' . $serviceName . ' tidak ditemukan.');
    }

    // Kelompokkan berdasarkan packageType
    $groupedPackages = $packages->groupBy('packageType');
    $savedPackageIds = $this->getSavedPackageIds();

    // Mapping View - Pastikan file 'packagenetflix.blade.php' benar-benar ada
    $viewMap = [
        'Netflix'     => 'packagenetflix',
        'Prime Video' => 'packageprime',
        'Viu'         => 'packageviu',
    ];

    // Fallback ke view 'package' jika nama tidak ada di map
    $viewName = $viewMap[$serviceName] ?? 'package';

    return view($viewName, [
        'packages'           => $groupedPackages,
        'serviceName'        => $serviceName,
        'serviceDescription' => 'Nikmati hiburan terbaik dari ' . $serviceName,
        'savedPackageIds'    => $savedPackageIds
    ]);
}

    /**
     * Menampilkan data dinamis untuk GUI Homepage:
     * 1. Active Package (Carousel di atas)
     * 2. Applications (Daftar logo layanan)
     * 3. Recommended for You (Katalog paket)
     * auliya malika 5026231141
     */
    public function showHomepage()
    {
        $user = Auth::user();

        // 1. DATA ACTIVE PACKAGE (Sesuai tabel user_subscriptions & package di ERD)
        // Mengambil paket yang sedang aktif untuk ditampilkan di carousel atas
        $activeSubscriptions = UserSubscription::with('package')
            ->where('userID', $user->userID)
            ->where('status', 'active')
            ->orderBy('endDate', 'asc')
            ->get();

        // Tambahkan atribut sisa waktu (untuk tampilan 1d 22h 48m di GUI)
        foreach ($activeSubscriptions as $sub) {
            $end = Carbon::parse($sub->endDate);
            $sub->remainingTime = Carbon::now()->diff($end)->format('%dd %hh %im');
        }

        // 2. DATA APPLICATIONS (Daftar layanan unik)
        // Mengambil serviceName dan logoSubscription agar muncul di section 'Applications'
        $applications = Package::select('serviceName', 'logoSubscription')
            ->groupBy('serviceName', 'logoSubscription')
            ->get();

        // 3. DATA RECOMMENDED (Katalog paket berdasarkan tipe)
        // Default menampilkan semua paket untuk section 'Recommended for You'
        $recommendedPackages = Package::all();

        return view('homepage', compact(
            'activeSubscriptions',
            'applications',
            'recommendedPackages'
        ));
    }
}
