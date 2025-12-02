<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Payment;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Dashboard main page - 5026231012 zihni
     */
    public function index()
    {
        $user = Auth::user();

        // Auto-expire packages FIRST
        $this->autoExpirePackages($user->userID);

        // Get active packages
        $activePackages = UserSubscription::where('userID', $user->userID)
            ->where('status', 'active')
            ->where('endDate', '>', Carbon::now())
            ->with(['package', 'accountPackage'])
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

        $this->autoExpirePackages($user->userID);

        $orderHistory = UserSubscription::where('userID', $user->userID)
            ->with('package')
            ->orderBy('startDate', 'desc')
            ->paginate(10);

        return view('dashboard.history', compact('orderHistory'));
    }

    /**
     * Package detail page - 5026231012 zihni
     * OPTIMIZED: Calculate everything in controller, pass to view
     */
    public function packageDetail($id)
    {
        $user = Auth::user();

        $subs = UserSubscription::where('userSubscriptionID', $id)
            ->where('userID', $user->userID)
            ->with(['package', 'accountPackage'])
            ->with(['package', 'accountPackage'])
            ->firstOrFail();

        // Auto-expire and refresh
        $this->autoExpirePackages($user->userID);
        $subscription->refresh();

        // Calculate ALL time-related data here (no duplication in view)
        $now = Carbon::now();
        $endDate = Carbon::parse($subscription->endDate);

        // Determine status
        $isExpired = $now->greaterThan($endDate);
        $isActive = $subscription->status === 'active' && !$isExpired;

        // Calculate time difference
        $diff = $now->diff($endDate);
        $daysRemaining = $now->diffInDays($endDate, false);

        // Debug logging
        Log::info("Package Detail", [
            'id' => $id,
            'status' => $subscription->status,
            'end_date' => $endDate->toDateTimeString(),
            'now' => $now->toDateTimeString(),
            'is_expired' => $isExpired,
            'is_active' => $isActive,
            'days_remaining' => $daysRemaining
        ]);

        return view('dashboard.activepackage', compact(
            'subscription',
            'isActive',
            'isExpired',
            'daysRemaining',
            'diff',
            'now',
            'endDate'
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
     * SINGLE METHOD: Auto-expire packages
     * Used by all other methods - no duplication
     *
     * @param int|null $userID - If provided, only expire for this user. If null, expire all.
     * @return int Number of expired packages
     */
    private function autoExpirePackages($userID = null)
    {
        $query = UserSubscription::where('status', 'active')
            ->where('endDate', '<=', Carbon::now());

        if ($userID) {
            $query->where('userID', $userID);
        }

        $expiredCount = $query->update(['status' => 'expired']);

        if ($expiredCount > 0) {
            Log::info("Auto-expired {$expiredCount} packages" . ($userID ? " for user {$userID}" : ""));
        }

        return $expiredCount;
    }

    /**
     * Public API endpoint for manual/cron expiration
     * Calls the same autoExpirePackages method
     */
    public function checkExpiredPackages()
    {
        $expiredCount = $this->autoExpirePackages(); // null = expire all users

        return response()->json([
            'success' => true,
            'expired_count' => $expiredCount,
            'timestamp' => Carbon::now()->toDateTimeString()
        ]);
    }

    /**
     * AJAX dashboard stats
     */
    public function getStats()
    {
        $user = Auth::user();
        $this->autoExpirePackages($user->userID);

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
        $this->autoExpirePackages($user->userID);

        $subscription = UserSubscription::where('userSubscriptionID', $id)
            ->where('userID', $user->userID)
            ->with(['package', 'accountPackage'])
            ->firstOrFail();

        $payment = Payment::where('userID', $user->userID)
            ->where('packageID', $subscription->packageID)
            ->with(['package', 'paymentMethod', 'discount'])
            ->orderBy('paymentDate', 'desc')
            ->first();

        if (!$payment) {
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
