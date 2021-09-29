<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class QueryProductStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:query_stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update variation stock';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     *
     */
    public function handle() {
        if(Order::whereDay('created_at', now()->day)->exists()) {
            try {
                DB::transaction(function() {
                    Product::whereHas('variations')->chunk(100, function($products, $i) {
                        $this->info("Starting chunk - $i:");

                        foreach($products as $product) {
                            $this->info(" Querying ... {$product->title}! ~ current stock = {$product->stock}");

                            $stock = $product->stock;
                            $product->stock = $stock;
                            $product->save();
                        }
                    });
                });
            } catch(Throwable $e) {
                Log::error($e->getMessage());
            }

            $this->info('Query successful!');
        } else {
            $this->info('No orders placed today, thus none to query!');
        }
    }
}
