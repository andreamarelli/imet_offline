<?php

namespace App\Console;

use App\Console\Commands\InitIMETOfflineDBJobs;
use App\Jobs\RefreshCache;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Stringable;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        InitIMETOfflineDBJobs::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /*$schedule->job(new RefreshCache)
            ->dailyAt('03:00')
            ->withoutOverlapping()
            ->onSuccess(function () {
                \Storage::disk('storage_public')
                    ->append('scheduled_jobs.txt',
                             "[".Carbon::now()->format('Y-m-d H:i:s')."] - RefreshCache: successfully executed.\n");
            })
            ->onFailure(function (Stringable $output) {
                \Storage::disk('storage_public')
                    ->append('scheduled_jobs.txt',
                             "[".Carbon::now()->format('Y-m-d H:i:s')."] - RefreshCache: error. ".$output);
            });
        */
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
