<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Product extends Model
{
    /**
     * RELATIONSHIP FUNCTIONS
     */
    public static function products(): Builder
    {
        return self::with('brand', 'seller');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'seller_id', 'user_id');
    }

    public function brand(): BelongsTo {
        return $this->belongsTo(Brand::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(productsImage::class);
    }

    public function variations(): hasMany
    {
        return $this->hasMany(Variation::class)->with(['variationOptions' => function($query) {
            $query->where('status', 1)->where('stock', '>', 0);
        }]);
    }


    /**
     * STATIC FUNCTIONS
     * @param $productId
     * @return int
     */
    public static function getDiscountPrice($productId): int
    {
        $proDetails = self::select('base_price', 'discount', 'category_id')->where('id', $productId)->first()->toArray();
        $catDetails = Category::select('discount')->where('id', $proDetails['category_id'])->first()->toArray();

        if($proDetails['discount'] > 0) {
            $discountPrice = $proDetails['base_price'] - ($proDetails['base_price'] * $proDetails['discount'] / 100);
        } else if($catDetails['discount'] > 0) {
            $discountPrice = $proDetails['base_price'] - ($proDetails['base_price'] * $catDetails['discount'] / 100);
        } else {
            $discountPrice = 0;
        }

        return $discountPrice;
    }

    use HasFactory;
}
