<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



    /**
     * STATIC FUNCTIONS
     */
    public static function cartItems(): array
    {
        if(Auth::check()) {
            $cartItems = self::with(['product' => static function($query) {
                $query->select('id', 'title', 'main_image', 'base_price', 'discount');
            }])->where('user_id', Auth::id())->orderByDesc('id')->get()->toArray();
        } else {
            $cartItems = self::with(['product' => static function($query) {
                $query->select('id', 'title', 'main_image', 'base_price', 'discount');
            }])->where('session_id', Session::get('session_id'))->orderByDesc('id')->get()->toArray();
        }

        return $cartItems;
    }

    public static function getVariationPrice($productId, $variations): array
    {
        $basePrice = Product::where('id', (int)$productId)->value('base_price');
        $extraPrice = Variation::join('variations_options', 'variations.id', 'variations_options.variation_id')
            ->whereIn('variant', $variations)
            ->where('product_id', $productId)->sum('extra_price');

        $newPrice = $basePrice + $extraPrice;

        return Product::getVariationDiscountPrice($productId, $newPrice);
    }

    use HasFactory;

    public $table = "cart";
}
