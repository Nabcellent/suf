<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Variation extends Model
{
    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function variations(): hasMany
    {
        return $this->hasMany(VariationOption::class);
    }

    use HasFactory;

    public $timestamps = false;
}
