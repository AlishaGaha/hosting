<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Client;
use App\Jobs\SendEmailJob;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // 'App\Console\Commands\NotifyClients'
    ];

    protected function scheduleTimezone()
    {
        return 'Asia/Kathmandu';
    }

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $clients = Client::select('id', 'first_name', 'email', 'hosting_renewal', 'hosting_renewal_type', 'domain_renewal', 'domain_renewal_type', 'updated_at')->get();
        $currentDate = Carbon::now()->format('Y-m-d');
        if(isset($clients)) {
            foreach( $clients as $client) {
                if($client->domain_renewal_type == 'Month' || $client->hosting_renewal_type == 'Month') {
                    $expiry_date = isset($client->domain_renewal) ?
                        $client->updated_at->format('Y-m-d')
                        :
                        $client->updated_at->format('Y-m-d');
                    // $expiry_date = isset($client->domain_renewal) ?
                    //     $client->updated_at->addMonths($client->domain_renewal)->subDays(5)->format('Y-m-d')
                    //     :
                    //     $client->updated_at->addMonths($client->hosting_renewal)->subDays(5)->format('Y-m-d');
                    if($currentDate == $expiry_date) {
                        // $schedule->job(new SendEmailJob($client->email, $client->first_name))->dailyAt('9:00');
                        $schedule->job(new SendEmailJob($client->email, $client->first_name))->everyMinute();
                    }
                    // $schedule->job(new SendEmailJob($client->email))->monthlyOn($client->updated_at->format('d'), '9:00');
                } else if($client->domain_renewal_type == 'Year' || $client->hosting_renewal_type == 'Year') {
                    $expiry_date = isset($client->domain_renewal) ?
                        $client->updated_at->format('Y-m-d')
                        :
                        $client->updated_at->format('Y-m-d');
                    // $expiry_date = isset($client->domain_renewal) ?
                    //     $client->updated_at->addYears($client->domain_renewal)->subMonths(1)->format('Y-m-d')
                    //     :
                    //     $client->updated_at->addYears($client->hosting_renewal)->subMonths(1)->format('Y-m-d');
                    if($currentDate == $expiry_date) {
                        // $schedule->job(new SendEmailJob($client->email, $client->first_name))->dailyAt('9:00');
                        $schedule->job(new SendEmailJob($client->email, $client->first_name))->everyMinute();
                    }
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
