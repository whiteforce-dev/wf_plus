<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\CloneOldOnroleCandidate::class,
        Commands\CloneOldOffroleCandidate::class,
        Commands\GetShineJob::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        try {
            $schedule->call('\App\Http\Controllers\PipelineController@deleteBatchHeader')->dailyAt('7:00');
        } catch (\Exception $e) {}

        try {
            $schedule->command('command:getshinejob')->everyTenMinutes();
        } catch (\Exception $e) {}


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
