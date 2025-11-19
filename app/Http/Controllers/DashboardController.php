<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Payment;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
}
