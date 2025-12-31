<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\SavedPackage;

class SubscriptionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | 1. MELIHAT PAKET (Hourly, Daily, Monthly)
    |--------------------------------------------------------------------------
    */

    public function showHourly()
    {
        $paket = Subscription::where('packageType', 'Hourly')->get();
        return view('paket.hourly', compact('paket'));
    }

    public function showDaily()
    {
        $paket = Subscription::where('packageType', 'Daily')->get();
        return view('paket.daily', compact('paket'));
    }

    public function showMonthly()
    {
        $paket = Subscription::where('packageType', 'Monthly')->get();
        return view('paket.monthly', compact('paket'));
    }

    /*
    |--------------------------------------------------------------------------
    | 2. MENCARI PAKET (Search)
    |--------------------------------------------------------------------------
    */

    public function cariPaket(Request $request)
    {
        $keyword = $request->input('keyword');

        $paket = Subscription::where('serviceName', 'LIKE', "%$keyword%")
                    ->orWhere('packageType', 'LIKE', "%$keyword%")
                    ->get();

        return $this->showPackage($paket);
    }

    // View hasil pencarian
    public function showPackage($paket)
    {
        return view('paket.hasilSearch', compact('paket'));
    }

    /*
    |--------------------------------------------------------------------------
    | 3. MEMFILTER PAKET
    |--------------------------------------------------------------------------
    */

    // GET /Search → cariPaket() dipanggil
    // (Sudah tercakup di atas)

    // GET /Filter → Keyword()
    public function Keyword(Request $request)
    {
        $keyword = $request->input('keyword');

        $paket = Subscription::where('packageType', $keyword)->get();

        return $this->showKeyword($paket);
    }

    public function showKeyword($paket)
    {
        return view('paket.hasilFilter', compact('paket'));
    }

    /*
    |--------------------------------------------------------------------------
    | 4. MENYIMPAN PAKET created by Muhammad Naufal Erwin E 5026231152
    |--------------------------------------------------------------------------
    */

    // GET /savedPackage
    public function SavedBaru(Request $request)
    {
        $id = $request->input('subscriptionID');

        WishlistPackage::create([
            'subscriptionID' => $id,
            'userID' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Paket berhasil disimpan ke wishlist!');
    }


    /*
    |--------------------------------------------------------------------------
    | 5. MEMILIH PAKET created by Muhammad Naufal Erwin E 5026231152
    |--------------------------------------------------------------------------
    */

    public function paketPilihan(Request $request)
    {
        $id = $request->input('subscriptionID');

        $paket = Subscription::findOrFail($id);

        return view('paket.pilih', compact('paket'));
    }
}
