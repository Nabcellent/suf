<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'seller_id',
        'brand_id',
        'title',
        'main_image',
        'keywords',
        'description',
        'label',
        'base_price',
        'discount',
        'is_featured'
    ];

    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->with('category');
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
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
     */
    public static function products() {
        return self::with('seller');
    }

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

    public static function getVariationDiscountPrice($productId, $newPrice): array
    {
        $proDetails = self::select('base_price', 'discount', 'category_id')->where('id', $productId)->first()->toArray();
        $catDetails = Category::select('discount')->where('id', $proDetails['category_id'])->first()->toArray();

        if($proDetails['discount'] > 0) {
            $discountPrice = $newPrice - ($newPrice * $proDetails['discount'] / 100);
            //  Get Discount
            $discount = $newPrice - $discountPrice;
        } else if($catDetails['discount'] > 0) {
            $discountPrice = $newPrice - ($newPrice * $catDetails['discount'] / 100);
            $discount = $newPrice - $discountPrice;
        } else {
            $discountPrice = $newPrice;
            $discount = 0;
        }

        return array('unit_price' => $newPrice, 'discount_price' => $discountPrice, 'discount' => $discount);
    }


    /**
     * --------------------------------------------------------------------------------------------------ADMIN FUNCTIONS
    */
    public static function productDetails($id): Builder
    {
        return self::where('id', $id)->with('subCategory', 'seller', 'brand', 'variations', 'images');
    }
}
