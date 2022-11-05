<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Log;

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
        // $schedule->command('hello:world')->everyMinute();
        // $schedule->command('user:end_stock')->everyMinute();
        // $schedule->call('App\Http\Controllers\LoginController@logout_user')->everyMinute();
        $schedule->call('Full\Namespace\LoginController@logout_user')->everyMinute();

        $schedule->call(function () {
            Log::channel('my_logs')->info('Scheduler Scheduler');
        })->everyMinute();
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
