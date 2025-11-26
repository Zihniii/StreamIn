<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    /**
     * Menampilkan halaman paket Netflix
     */
    public function showNetflix()
    {
        // Ambil semua paket Netflix dari database
        $packages = DB::table('package')
            ->where('serviceName', 'Netflix')
            ->orderByRaw("FIELD(packageType, 'Hourly', 'Daily', 'Monthly')")
            ->orderBy('durasiPackage', 'asc')
            ->get();

        // Kelompokkan paket berdasarkan tipe (Hourly, Daily, Monthly)
        $groupedPackages = $packages->groupBy('packageType');

        return view('packagenetflix', [
            'packages' => $groupedPackages,
            'serviceName' => 'Netflix',
            'serviceDescription' => 'Nikmati pengalaman menonton tanpa batas dengan paket Netflix khusus. Dapatkan akses ke ribuan film, serial, dan dokumenter terbaik di dunia. Tidak ada iklan, tidak ada gangguan, hanya hiburan berkualitas untuk setiap momen.'
        ]);
    }

    public function showPrime()
    {
        // Ambil semua paket Netflix dari database
        $packages = DB::table('package')
            ->where('serviceName', 'Prime Video')
            ->orderByRaw("FIELD(packageType, 'Hourly', 'Daily', 'Monthly')")
            ->orderBy('durasiPackage', 'asc')
            ->get();

        // Kelompokkan paket berdasarkan tipe (Hourly, Daily, Monthly)
        $groupedPackages = $packages->groupBy('packageType');

        return view('packageprime', [
            'packages' => $groupedPackages,
            'serviceName' => 'Prime Video',
            'serviceDescription' => 'Nikmati pengalaman menonton tanpa batas dengan paket Prime Video khusus. Dapatkan akses ke ribuan film, serial, dan dokumenter terbaik di dunia. Tidak ada iklan, tidak ada gangguan, hanya hiburan berkualitas untuk setiap momen.'
        ]);
    }

    public function showViu()
    {
        // Ambil semua paket Netflix dari database
        $packages = DB::table('package')
            ->where('serviceName', 'Viu')
            ->orderByRaw("FIELD(packageType, 'Hourly', 'Daily', 'Monthly')")
            ->orderBy('durasiPackage', 'asc')
            ->get();

        // Kelompokkan paket berdasarkan tipe (Hourly, Daily, Monthly)
        $groupedPackages = $packages->groupBy('packageType');

        return view('packageviu', [
            'packages' => $groupedPackages,
            'serviceName' => 'Viu',
            'serviceDescription' => 'Nikmati pengalaman menonton tanpa batas dengan paket Viu khusus. Dapatkan akses ke ribuan film, serial, dan dokumenter terbaik di dunia. Tidak ada iklan, tidak ada gangguan, hanya hiburan berkualitas untuk setiap momen.'
        ]);
    }

    /**
     * Menampilkan halaman paket untuk service lainnya (generic)
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

        $descriptions = [
            'Netflix' => 'Nikmati pengalaman menonton tanpa batas dengan paket Netflix khusus.',
            'Prime Video' => 'Akses ribuan film dan series eksklusif dengan Amazon Prime Video.',
            'Viu' => 'Tonton drama Asia terbaik dan konten eksklusif di Viu.',
        ];

        return view('packagenetflix', [
            'packages' => $groupedPackages,
            'serviceName' => $serviceName,
            'serviceDescription' => $descriptions[$serviceName] ?? 'Nikmati streaming berkualitas tinggi.'
        ]);
    }
}