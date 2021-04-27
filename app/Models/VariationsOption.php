<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VariationsOption extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'variation_id',
        'variant',
        'stock',
        'extra_price',
    ];

    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function variation(): BelongsTo
    {
        return $this->belongsTo(Variation::class);
    }

    use HasFactory;

    public $timestamps = false;
}
