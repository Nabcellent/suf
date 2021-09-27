<?php

namespace App\Models;

use App\Helpers\Searchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 * @mixin IdeHelperProduct
 */
class Product extends Model {
    use HasFactory, Searchable;

    protected array $searchable = [
        'title',
        'description',
        'label',
        'keywords',
    ];

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
     * MUTATORS
    */
    public function getAverageRatingAttribute(): float {
        return round($this->reviews->where('rating', '<>', null)->avg('rating'), 1);
    }

    public function getStockAttribute($value): int {
        return $this->variations->isNotEmpty()
            ? $this->variations->pluck('options')->collapse()->sum('stock') : $value;
    }



    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function subCategory(): BelongsTo {
        return $this->belongsTo(Category::class, 'category_id', 'id')
            ->with('category');
    }

    public function seller(): BelongsTo {
        return $this->belongsTo(User::class)->with('admin');
    }

    public function brand(): BelongsTo {
        return $this->belongsTo(Brand::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductsImage::class);
    }

    public function variations(): hasMany {
        return $this->hasMany(Variation::class)->with('attribute');
    }

    public function reviews(): HasMany {
        return $this->hasMany(Review::class);
    }


    /**
     * STATIC FUNCTIONS
     */
    public static function products(): Builder {
        return self::with('subCategory', 'brand', 'seller');
    }

    public static function getDiscountPrice($productId): int {
        $proDetails = self::select(['base_price', 'discount', 'category_id'])->where('id', $productId)->first()->toArray();
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

    public static function getVariationDiscountPrice($productId, $newPrice): array {
        $proDetails = self::select(['base_price', 'discount', 'category_id'])->where('id', $productId)->first()->toArray();
        $catDetails = Category::select('discount')->where('id', $proDetails['category_id'])->first()->toArray();

        if($proDetails['discount'] > 0) {
            $discountPrice = $newPrice - ($newPrice * $proDetails['discount'] / 100);
            $discount = $newPrice - $discountPrice;
        } else if($catDetails['discount'] > 0) {
            $discountPrice = $newPrice - ($newPrice * $catDetails['discount'] / 100);
            $discount = $newPrice - $discountPrice;
        } else {
            $discountPrice = $newPrice;
            $discount = 0;
        }

        return array('unit_price' => ceil($newPrice), 'discount_price' => ceil($discountPrice), 'discount' => ceil($discount));
    }

    public static function productStatus($id) {
        return self::findOrFail($id, ['status'])->status;
    }

    public static function stock($id, $aggregate = "min" | "sum" | "max", $attributes = null) {
        if($attributes) {
            $stock = Variation::where('product_id', $id)->pluck('options')
                ->collapse()->filter(function($value, $key) use($attributes) {
                    return in_array($key, $attributes);
                });

            return match($aggregate) {
                "min" => $stock->min('stock'),
                "sum" => $stock->sum('stock'),
                "max" => $stock->max('stock'),
            };
        } else {
            return self::findOrFail($id)->stock;
        }
    }

    public static function attributesAreAvailable($id, $attributes): bool|string {
        $options = Variation::where('product_id', $id)->pluck('options')->collapse();

        foreach($options as $key => $option) {
            if(in_array($key, $attributes) && $option['status'] === 0) {
                return $key;
            }
        }

        return false;
    }


    /**
     * --------------------------------------------------------------------------------------------------ADMIN FUNCTIONS
    */
    public static function productDetails($id): Builder {
        return self::where('id', $id)->with('subCategory', 'seller', 'brand', 'variations', 'images');
    }
}
