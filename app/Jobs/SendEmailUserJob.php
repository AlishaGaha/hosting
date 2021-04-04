<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\UserMail;
use Mail;

class SendEmailUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email;
    protected $username;
    protected $client_name;
    protected $expiry_date;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $username, $client_fname, $client_lname, $expiry_date)
    {
        $this->email = $email;
        $this->username = $username;
        $this->client_name = $client_fname.' '.$client_lname;
        $this->expiry_date = $expiry_date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $details = [
            'title' => 'Expiration of domain and hosting subscription of '.$this->client_name,
            'body' => 'Subscription of domain and hosting subscription will expire in '.$this->expiry_date
        ];

        Mail::to($this->email)->queue(new UserMail(
            $details,
            $this->username
        ));
    }
}
