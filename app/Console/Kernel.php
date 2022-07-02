<?php

namespace App\Console;

use App\Jobs\CategoryThreadCount;
use App\Jobs\ThreadReplyCount;
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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        if (env('APP_ENV') === 'production') {
//            $schedule->command('backup:clean')->daily()->at('01:00');
//            $schedule->command('backup:run')->daily()->at('02:00');
//        }

        $schedule->job(new CategoryThreadCount)->hourly()->withoutOverlapping();
        $schedule->job(new ThreadReplyCount)->hourly()->withoutOverlapping();

        $schedule->command('telescope:prune')->daily();
        $schedule->command('horizon:snapshot')->everyFiveMinutes();
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
