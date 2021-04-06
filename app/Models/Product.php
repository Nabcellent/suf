<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /**
     * RELATIONSHIP FUNCTIONS
     */
    public static function products(): Builder
    {
        return self::with('brand', 'seller');
    }

    public function categories(): BelongsTo
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
        return $this->hasMany(productImage::class);
    }

    public function variations(): hasMany
    {
        return $this->hasMany(Variation::class);
    }

    use HasFactory;
}
