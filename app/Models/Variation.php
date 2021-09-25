<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

/**
 * @mixin IdeHelperVariation
 */
class Variation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'attribute_id',
        'options',
    ];

    protected $casts = [
        'options' => 'array'
    ];

    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }

    public function attribute(): BelongsTo {
        return $this->belongsTo(Attribute::class);
    }



    /**
     * STATIC FUNCTIONS
     */
    public static function checkVariations($productId, $variationOptions): Builder {
        return self::join('variations_options', 'variations.id', 'variations_options.variation_id')
            ->where('product_id', $productId)
            ->whereIn('variant', $variationOptions);
    }

    use HasFactory;

    public $timestamps = false;
}
