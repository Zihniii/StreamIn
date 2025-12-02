<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Run expiration check every hour
        $schedule->call(function () {
            \App\Models\UserSubscription::where('status', 'active')
                ->where('endDate', '<=', \Carbon\Carbon::now())
                ->update(['status' => 'expired']);
        })->hourly()->name('expire-subscriptions')->withoutOverlapping();

        // Alternative: Run every 15 minutes for faster updates
        // $schedule->call(function () {
        //     \App\Models\UserSubscription::where('status', 'active')
        //         ->where('endDate', '<=', \Carbon\Carbon::now())
        //         ->update(['status' => 'expired']);
        // })->everyFifteenMinutes()->name('expire-subscriptions')->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
