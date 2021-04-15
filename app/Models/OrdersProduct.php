<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrdersProduct extends Model
{
    use HasFactory;

    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }



    /**
     * STATIC FUNCTIONS
     */
}
