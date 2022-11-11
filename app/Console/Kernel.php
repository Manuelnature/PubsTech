<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Log;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\salesAuditController;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('audit:users')->everyMinute();
        // $schedule->command('hello:world')->everyMinute();

        // $schedule->call(LoginController::update_sales_audit())->everyMinute();

        // $schedule->call([LoginController::class, 'update_sales_audit'])->everyMinute();
        $schedule->call([salesAuditController::class, 'update_sales_audit'])->everySixHours();


        // $schedule->call(function () {
        //     Log::channel('my_logs')->info('Scheduler Scheduler');
        // })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
