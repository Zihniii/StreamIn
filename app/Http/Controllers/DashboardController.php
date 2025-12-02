<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Payment;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Dashboard main page - 5026231012 zihni
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil semua subscription aktif yg belum expired
        $activePackages = UserSubscription::where('userID', $user->userID)
            ->where('status', 'active')
            ->where('endDate', '>', Carbon::now())
            ->with(['package', 'accountPackage'])
            ->orderBy('endDate', 'asc')
            ->get();

        $totalActivePackages = $activePackages->count();

        // Expiring soon (3 days)
        $expiringPackages = $activePackages->filter(function ($s) {
            $days = Carbon::now()->diffInDays($s->endDate, false);

            return $days <= 3 && $days >= 0;
        });

        return view('dashboard.dashboard', compact(
            'activePackages',
            'totalActivePackages',
            'expiringPackages'
        ));
    }

    /**
     * Order history (payment history) - 5026231012 zihni
     */
    public function orderHistory()
    {
        $user = Auth::user();

        $orderHistory = UserSubscription::where('userID', $user->userID)
            ->with('package')
            ->orderBy('startDate', 'desc')
            ->paginate(10);

        return view('dashboard.history', compact('orderHistory'));
    }

    /**
     * Package detail page - 5026231012 zihni
     */
    public function packageDetail($id)
    {
        $user = Auth::user();

        $subs = UserSubscription::where('userSubscriptionID', $id)
            ->where('userID', $user->userID)
            ->with(['package', 'accountPackage'])
            ->firstOrFail();

        $daysRemaining = Carbon::now()->diffInDays($subs->endDate, false);

        return view('dashboard.activepackage', compact(
            'subs',
            'daysRemaining'
        ));
    }

    /**
     * Browse all available packages - 5026231012 zihni
     */
    public function browsePackages()
    {
        $packages = Package::orderBy('serviceName', 'asc')->get();

        $packagesByPlatform = $packages->groupBy('serviceName');

        return view('packages.browse', compact('packages', 'packagesByPlatform'));
    }

    /**
     * Auto-mark expired packages - zihni
     */
    public function checkExpiredPackages()
    {
        $expired = UserSubscription::where('status', 'active')
            ->where('endDate', '<=', Carbon::now())
            ->get();

        foreach ($expired as $sub) {
            $sub->update(['status' => 'expired']);
        }

        return response()->json([
            'success' => true,
            'expired_count' => $expired->count(),
        ]);
    }

    /**
     * AJAX dashboard stats
     */
    public function getStats()
    {
        $user = Auth::user();

        $stats = [
            'active_packages' => UserSubscription::where('userID', $user->userID)
                ->where('status', 'active')
                ->where('endDate', '>', Carbon::now())
                ->count(),

            'total_orders' => Payment::where('userID', $user->userID)->count(),

            'expiring_soon' => UserSubscription::where('userID', $user->userID)
                ->where('status', 'active')
                ->where('endDate', '>', Carbon::now())
                ->where('endDate', '<=', Carbon::now()->addDays(3))
                ->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Order history detail - bagas 24/11/2005
     */
    public function orderHistoryDetail($id)
    {
        $user = Auth::user();

        // Ambil data subscription
        $subscription = UserSubscription::where('userSubscriptionID', $id)
            ->where('userID', $user->userID)
            ->with(['package', 'accountPackage'])
            ->firstOrFail();

        // Ambil payment terkait subscription ini
        $payment = Payment::where('userID', $user->userID)
            ->where('packageID', $subscription->packageID)
            ->with(['package', 'paymentMethod', 'discount'])
            ->orderBy('paymentDate', 'desc')
            ->first();

        // Jika tidak ada payment, buat dummy data
        if (! $payment) {
            $payment = new Payment([
                'paymentID' => 0,
                'amount' => $subscription->package->hargaPackage ?? 0,
                'adminFee' => 0,
                'paymentDate' => $subscription->startDate,
                'paymentStatus' => 'completed',
            ]);
            $payment->package = $subscription->package;
            $payment->paymentMethod = (object) ['methodName' => 'N/A'];
        }

        return view('dashboard.historydetail', compact('payment', 'subscription'));
    }

    /**
     * Search by keyword - auliya 25/11/2005
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        // Jika tidak ada keyword, tampilkan semua package
        if (! $query) {
            $packages = Package::all();
        } else {
            $packages = Package::where('serviceName', 'LIKE', "%{$query}%")
                ->orWhere('packageType', 'LIKE', "%{$query}%")
                ->orWhere('descriptionPackage', 'LIKE', "%{$query}%")
                ->get();
        }

        return view('search', compact('packages', 'query'));
    }
}
