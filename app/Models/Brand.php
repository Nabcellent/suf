<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    public static function brands(): Builder
    {
        return self::with('products');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    use HasFactory;
}
