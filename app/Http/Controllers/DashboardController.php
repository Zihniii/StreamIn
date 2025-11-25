<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Payment;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Dashboard main page
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil semua subscription aktif yg belum expired
        $activePackages = UserSubscription::where('userID', $user->userID)
            ->where('status', 'active')
            ->where('endDate', '>', Carbon::now())
            ->with('package')
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
     * Order history (payment history)
     */
    public function orderHistory()
    {
        $user = Auth::user();

        $orders = Payment::where('userID', $user->userID)
            ->with('package')
            ->orderBy('paymentDate', 'desc')
            ->paginate(10);

        return view('dashboard.history', compact('orders'));
    }

    /**
     * Package detail page
     */
    public function packageDetail($id)
    {
        $user = Auth::user();

        $subscription = UserSubscription::where('userSubscriptionID', $id)
            ->where('userID', $user->userID)
            ->with('package')
            ->firstOrFail();

        $daysRemaining = Carbon::now()->diffInDays($subscription->endDate, false);

        return view('dashboard.activepackage', compact(
            'subscription',
            'daysRemaining'
        ));
    }

    /**
     * Browse all available packages
     */
    public function browsePackages()
    {
        $packages = Package::orderBy('serviceName', 'asc')->get();

        $packagesByPlatform = $packages->groupBy('serviceName');

        return view('packages.browse', compact('packages', 'packagesByPlatform'));
    }

    /**
     * User profile summary
     */
    public function profile()
    {
        $user = Auth::user();

        $totalSubscriptions = UserSubscription::where('userID', $user->userID)->count();

        $totalOrders = Payment::where('userID', $user->userID)->count();

        $totalSpent = Payment::where('userID', $user->userID)
            ->where('paymentStatus', 'completed')
            ->sum('amount');

        return view('profile', compact(
            'user',
            'totalSubscriptions',
            'totalOrders',
            'totalSpent'
        ));
    }

    /**
     * Auto-mark expired packages
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
        if (!$payment) {
            $payment = new Payment([
                'paymentID' => 0,
                'amount' => $subscription->package->hargaPackage ?? 0,
                'adminFee' => 0,
                'paymentDate' => $subscription->startDate,
                'paymentStatus' => 'completed',
            ]);
            $payment->package = $subscription->package;
            $payment->paymentMethod = (object)['methodName' => 'N/A'];
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
        if (!$query) {
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
