<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;
use App\Models\Package;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the dashboard with active packages
     */
    public function index()
    {
        $user = Auth::user();

        // Get active subscriptions/packages
        $activePackages = Subscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->where('expires_at', '>', Carbon::now())
            ->with('package')
            ->orderBy('expires_at', 'asc')
            ->get();

        // Calculate total active packages
        $totalActivePackages = $activePackages->count();

        // Get packages expiring soon (within 3 days)
        $expiringPackages = $activePackages->filter(function ($subscription) {
            $daysUntilExpiry = Carbon::now()->diffInDays($subscription->expires_at, false);
            return $daysUntilExpiry <= 3 && $daysUntilExpiry >= 0;
        });

        return view('dashboard', compact(
            'activePackages',
            'totalActivePackages',
            'expiringPackages'
        ));
    }

    /**
     * Show order history
     */
    public function orderHistory()
    {
        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)
            ->with(['package', 'payment'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.history', compact('orders'));
    }

    /**
     * Show package detail
     */
    public function packageDetail($id)
    {
        $user = Auth::user();

        $subscription = Subscription::where('id', $id)
            ->where('user_id', $user->id)
            ->with('package')
            ->firstOrFail();

        // Calculate days remaining
        $daysRemaining = Carbon::now()->diffInDays($subscription->expires_at, false);

        // Get usage history if available
        $usageHistory = $subscription->usageHistory()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('packages.detail', compact(
            'subscription',
            'daysRemaining',
            'usageHistory'
        ));
    }

    /**
     * Browse available packages
     */
    public function browsePackages()
    {
        $packages = Package::where('is_active', true)
            ->orderBy('platform_name', 'asc')
            ->get();

        // Group packages by platform
        $packagesByPlatform = $packages->groupBy('platform_name');

        return view('packages.browse', compact('packages', 'packagesByPlatform'));
    }

    /**
     * Show user profile
     */
    public function profile()
    {
        $user = Auth::user();

        // Get total subscriptions
        $totalSubscriptions = Subscription::where('user_id', $user->id)->count();

        // Get total orders
        $totalOrders = Order::where('user_id', $user->id)->count();

        // Get total spent
        $totalSpent = Order::where('user_id', $user->id)
            ->where('status', 'completed')
            ->sum('amount');

        return view('profile', compact(
            'user',
            'totalSubscriptions',
            'totalOrders',
            'totalSpent'
        ));
    }

    /**
     * Check and update expired packages
     */
    public function checkExpiredPackages()
    {
        $expiredPackages = Subscription::where('status', 'active')
            ->where('expires_at', '<=', Carbon::now())
            ->get();

        foreach ($expiredPackages as $subscription) {
            $subscription->update(['status' => 'expired']);
        }

        return response()->json([
            'success' => true,
            'expired_count' => $expiredPackages->count()
        ]);
    }

    /**
     * Get dashboard statistics (for AJAX)
     */
    public function getStats()
    {
        $user = Auth::user();

        $stats = [
            'active_packages' => Subscription::where('user_id', $user->id)
                ->where('status', 'active')
                ->where('expires_at', '>', Carbon::now())
                ->count(),

            'total_orders' => Order::where('user_id', $user->id)->count(),

            'points' => $user->points ?? 0,

            'expiring_soon' => Subscription::where('user_id', $user->id)
                ->where('status', 'active')
                ->where('expires_at', '>', Carbon::now())
                ->where('expires_at', '<=', Carbon::now()->addDays(3))
                ->count()
        ];

        return response()->json($stats);
    }
}
