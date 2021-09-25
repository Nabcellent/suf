<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperBrand
 */
class Brand extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     *  RELATIONSHIP FUNCTIONS
     */
    public static function brands(): Builder
    {
        return self::with('products');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
