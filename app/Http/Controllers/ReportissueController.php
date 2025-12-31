<?php

namespace App\Http\Controllers;
use App\Models\ReportIssue;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


    // =============================================
    // Coded by: Zihni Aryanto Putra Buana
    // NRP: 5026231012
    // =============================================

class ReportIssueController extends Controller
{
    /**
     * Show report trouble form
     */
    public function showReportForm($subscriptionId)
    {
        $user = Auth::user();

        $subscription = UserSubscription::where('userSubscriptionID', $subscriptionId)
            ->where('userID', $user->userID)
            ->with('package')
            ->firstOrFail();

        return view('dashboard.report', compact('subscription'));
    }

    /**
     * Submit report trouble
     */
    public function submitReport(Request $request)
    {
        $user = Auth::user();

        // Validate request
        $validated = $request->validate([
            'issueCategory' => 'required|string|max:100',
            'issueDescription' => 'required|string|max:1000',
            'userSubscriptionID' => 'required|exists:user_subscriptions,userSubscriptionID',
            'attachment' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB max
        ]);

        // Verify subscription belongs to user
        $subscription = UserSubscription::where('userSubscriptionID', $validated['userSubscriptionID'])
            ->where('userID', $user->userID)
            ->firstOrFail();

        $attachmentPath = null;

        // Handle file upload
        if ($request->hasFile('attachment')) {
            try {
                $file = $request->file('attachment');
                $filename = 'report_'.time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

                // Store in public/storage/reports
                $attachmentPath = $file->storeAs('reports', $filename, 'public');

                Log::info("File uploaded successfully: {$attachmentPath}");
            } catch (\Exception $e) {
                Log::error('File upload failed: '.$e->getMessage());

                return response()->json([
                    'success' => false,
                    'message' => 'Failed to upload attachment. Please try again.',
                ], 500);
            }
        }

        // Create report
        try {
            $report = ReportIssue::create([
                'issueCategory' => $validated['issueCategory'],
                'issueDescription' => $validated['issueDescription'],
                'status' => 'pending',
                'createdAt' => Carbon::now(),
                'updatedAt' => Carbon::now(),
                'attachment' => $attachmentPath,
                'userID' => $user->userID,
                'userSubscriptionID' => $validated['userSubscriptionID'],
            ]);

            Log::info('Report created successfully', [
                'reportID' => $report->reportID,
                'userID' => $user->userID,
                'category' => $validated['issueCategory'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your report has been submitted successfully!',
                'reportID' => $report->reportID,
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to create report: '.$e->getMessage());

            // Clean up uploaded file if report creation fails
            if ($attachmentPath) {
                Storage::disk('public')->delete($attachmentPath);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to submit report. Please try again.',
            ], 500);
        }
    }

    /**
     * View user's reports
     */
    public function myReports()
    {
        $user = Auth::user();

        $reports = ReportIssue::where('userID', $user->userID)
            ->with(['subscription.package'])
            ->orderBy('createdAt', 'desc')
            ->paginate(10);

        return view('inbox', compact('reports'));
    }

    /**
     * View single report detail
     */
    public function reportDetail($id)
    {
        $user = Auth::user();

        $report = ReportIssue::where('reportID', $id)
            ->where('userID', $user->userID)
            ->with(['subscription.package'])
            ->firstOrFail();

        return view('inbox-detail', compact('report'));
    }

    public function updateStatus($id, Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,solved',
        ]);

        $report = ReportIssue::where('reportID', $id)
            ->where('userID', $user->userID)
            ->first();

        if (! $report) {
            return response()->json([
                'success' => false,
                'message' => 'Report not found or unauthorized',
            ], 404);
        }

        $report->status = $validated['status'];
        $report->updatedAt = now();
        $report->save();

        return response()->json(['success' => true]);
    }

    public function markAsSolved($id)
    {
        $user = Auth::user();

        $report = ReportIssue::where('reportID', $id)
            ->where('userID', $user->userID)
            ->first();

        if (! $report) {
            return response()->json([
                'success' => false,
                'message' => 'Report not found or unauthorized',
            ], 404);
        }

        if ($report->status === 'solved') {
            return response()->json([
                'success' => false,
                'message' => 'Report already solved',
            ]);
        }

        $report->status = 'solved';
        $report->updatedAt = now();
        $report->save();

        return response()->json(['success' => true]);
    }

    public function submitNewIssue(Request $request)
    {
        $user = Auth::user();

        // Validate request - FIX TABLE NAME
        $validated = $request->validate([
            'issueCategory' => 'required|string|max:100',
            'issueDescription' => 'required|string|max:1000',
            'userSubscriptionID' => 'required|exists:user_subscriptions,userSubscriptionID',
            'report_id' => 'required|exists:reportissue,reportID', // FIXED: reportissue not reports
            'attachment' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        // Verify subscription belongs to user
        $subscription = UserSubscription::where('userSubscriptionID', $validated['userSubscriptionID'])
            ->where('userID', $user->userID)
            ->firstOrFail();

        // Verify the original report belongs to user
        $originalReport = ReportIssue::where('reportID', $validated['report_id'])
            ->where('userID', $user->userID)
            ->firstOrFail();

        $attachmentPath = null;

        // Handle file upload (same as submitReport)
        if ($request->hasFile('attachment')) {
            try {
                $file = $request->file('attachment');
                $filename = 'report_'.time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                $attachmentPath = $file->storeAs('reports', $filename, 'public');
                Log::info("New issue file uploaded: {$attachmentPath}");
            } catch (\Exception $e) {
                Log::error('File upload failed: '.$e->getMessage());

                return response()->json([
                    'success' => false,
                    'message' => 'Failed to upload attachment.',
                ], 500);
            }
        }

        try {
            // 1. Create new report
            $newReport = ReportIssue::create([
                'issueCategory' => $validated['issueCategory'],
                'issueDescription' => $validated['issueDescription'],
                'status' => 'pending',
                'createdAt' => Carbon::now(),
                'updatedAt' => Carbon::now(),
                'attachment' => $attachmentPath,
                'userID' => $user->userID,
                'userSubscriptionID' => $validated['userSubscriptionID'],
                // If you have parent_report_id column:
                // 'parent_report_id' => $validated['report_id'],
            ]);

            // 2. Update original report timestamp
            $originalReport->update([
                'updatedAt' => Carbon::now(),
            ]);

            Log::info('New related issue created', [
                'new_reportID' => $newReport->reportID,
                'original_reportID' => $validated['report_id'],
                'userID' => $user->userID,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your new issue has been reported!',
                'reportID' => $newReport->reportID,
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to create new issue: '.$e->getMessage());

            if ($attachmentPath) {
                Storage::disk('public')->delete($attachmentPath);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to submit new issue.',
            ], 500);
        }
    }
}
