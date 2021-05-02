<?php

namespace App\Console\Commands;

use App\Http\Controllers\API\MpesaController;
use Illuminate\Console\Command;

class StkStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mpesa:query_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check status of all pending transactions';
    private $mpesa;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(MpesaController $registerUrl)
    {
        parent::__construct();
        $this->mpesa = $registerUrl;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $results = $this->mpesa->queryStkStatus();
        dd($results);
    }
}
