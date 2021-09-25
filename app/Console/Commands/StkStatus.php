<?php

namespace App\Console\Commands;

use App\Repositories\Mpesa;
use Illuminate\Console\Command;

class StkStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpesa:stk_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check status of all pending transactions';
    private Mpesa $mpesa;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Mpesa $registerUrl)
    {
        parent::__construct();

        $this->mpesa = $registerUrl;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $results = $this->mpesa->queryStkStatus();
        dd($results);
    }
}
