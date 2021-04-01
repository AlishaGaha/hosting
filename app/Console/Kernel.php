<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Client;
use App\Jobs\SendEmailJob;

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
        $clients = Client::select('id', 'email', 'hosting_renewal', 'domain_renewal', 'created_at')->get();
        // if(isset($clients)) {
        //     foreach( $clients as $client) {
        //         if($client->domain_renewal == 'auto' || $client->hosting_renewal == 'auto') {
        //             $schedule->job(new SendEmailJob($client))->everyTwoMinutes();
        //         }
        //     }
        // }
        $clients = Client::select('id', 'email', 'hosting_renewal', 'domain_renewal', 'created_at')->get();
        if(isset($clients)) {
            foreach( $clients as $client) {
                if($client->domain_renewal == 'auto' || $client->hosting_renewal == 'auto') {
                    $schedule->job(new SendEmailJob($client))->yearlyOn($client->created_at->format('d F'), '10:00');
                } else if($client->domain_renewal == '2 years' || $client->domain_renewal == '2 years') {
                    $schedule->job(new SendEmailJob($client))->everyTwoYears($client->created_at->format('d F'), '10:00');
                } else if($client->domain_renewal == '5 years' || $client->domain_renewal == '5 years') {
                    $schedule->job(new SendEmailJob($client))->everyFiveYears($client->created_at->format('d F'), '10:00');
                }
            }
        }
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
