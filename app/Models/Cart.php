<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * @mixin IdeHelperCart
 */
class Cart extends Model {
    protected $guarded = [];

    protected $casts = [
        'details' => 'array'
    ];

    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class)->with('subCategory');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



    /**
     * STATIC FUNCTIONS
     */
    public static function cartItems(): Collection|array {
        if(Auth::check()) {
            $cartItems = self::with(['product' => static function($query) {
                $query->select('id', 'category_id', 'title', 'main_image', 'base_price', 'discount');
            }])->where('user_id', Auth::id())->orderByDesc('id')->get();
        } else {
            $cartItems = self::with(['product' => static function($query) {
                $query->select('id', 'category_id', 'title', 'main_image', 'base_price', 'discount');
            }])->where('session_id', Session::get('session_id'))->orderByDesc('id')->get();
        }

        return $cartItems;
    }

    public static function getVariationPrice($productId, $variations): array
    {
        $basePrice = Product::where('id', (int)$productId)->value('base_price');
        $extraPrice = Variation::where('product_id', $productId)->pluck('options')
            ->collapse()->filter(function($value, $key) use($variations) {
                return in_array($key, $variations);
            })->sum('extra_price');

        $newPrice = $basePrice + $extraPrice;

        return Product::getVariationDiscountPrice($productId, $newPrice);
    }

    use HasFactory;

    protected $table = 'cart';
}
