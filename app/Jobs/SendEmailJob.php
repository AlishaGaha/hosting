<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\Gmail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $client;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $details = [
            'title' => 'Expiration of domain and hosting subscription',
            'body' => 'Your subscription for domain and hosting service is expired. Please contain to renew it.'
        ];

        Mail::to($this->client->email)->send(new Gmail($details));
    }
}
