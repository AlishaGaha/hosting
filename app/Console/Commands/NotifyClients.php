<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Client;
use App\Jobs\SendEmailJob;
use Carbon\Carbon;
use App\Blog;

class NotifyClients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:clients';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send domain and hosting renewal mail to clients.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $clients = Client::select('id', 'email', 'hosting_renewal', 'domain_renewal', 'created_at')->get();
        // if(isset($clients)) {
        //     foreach( $clients as $client) {
        //     }
        // }
        dispatch(new SendEmailJob('alisha@gmail.com'));
        // $now = date("Y-m-d", strtotime(Carbon::now()));
        // logger($now);
        // $blogs = Blog::get();
        // if($blogs !== null){
        //     $blogs->where('publish_date', $now)->each(function($blog) {
        //         dispatch(new SendEmailJob('alisha@gmail.com'));
        //     });
        // }
    }
}
