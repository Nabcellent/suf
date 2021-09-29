<?php

namespace App\Jobs;

use App\Mail\OrderPlaced;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrdersProduct;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProcessOrder implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected Order $order;
    protected array $user;
    protected Collection|array $cart;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order, $cart, array $user) {
        $this->order = $order->withoutRelations();
        $this->user = $user;
        $this->cart = $cart;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $orderProducts = [];

        Log::info("Processing Order ...: {$this->order->order_no}");

        foreach($this->cart as $item) {
            $variation = Variation::where('product_id', $item->product_id);

            if($variation->exists()) {
                $variation->each(function ($variation) use($item) {
                    if(Arr::hasAny($variation->options, $item->details)) {
                        $options = $variation->options;

                        $optionsKey = Arr::first($item->details, function($val) use($variation, $options) {
                            return in_array($val, array_keys($options));
                        });

                        $currentOptions = $variation->options[$optionsKey];
                        $options[$optionsKey] = [
                            'image' => $currentOptions['image'],
                            'stock' => $currentOptions['stock'] - $item->quantity,
                            'extra_price' => $currentOptions['extra_price'],
                            'status' => $currentOptions['status'],
                        ];

                        if($options[$optionsKey]['stock'] === 0)
                            Artisan::queue('products:query_stock');

                        $variation->options = $options;
                        $variation->save();
                    }
                });
            } else {
                $product = Product::find($item->product_id);
                $product->stock -= $item->quantity;
                $product->save();
            }

            $finalPrice = Cart::getVariationPrice($item->product_id, $item->details)['discount_price'];

            OrdersProduct::create([
                'order_id' => $this->order->id,
                'product_id' => $item['product_id'],
                'details' => $item['details'],
                'quantity' => $item['quantity'],
                'price' => $finalPrice,
            ]);
        }

        //  Empty User Cart
        Cart::where('user_id', $this->order->user_id)->delete();
        Mail::to($this->user['email'])->send(new OrderPlaced($this->order, $this->user));

        Log::info("Order processing ... Completed.");
    }
}
