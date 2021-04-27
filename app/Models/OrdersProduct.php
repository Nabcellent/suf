<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

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

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class)->with('subCategory','brand', 'seller');
    }

    public function loggedSeller(): BelongsTo {
        return $this->BelongsTo(Product::class, 'product_id')->where('seller_id', Auth::id());
    }



    /**
     * STATIC FUNCTIONS
     */
}
