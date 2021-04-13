<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class DeliveryAddress extends Model
{
    use HasFactory;

    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subCounty(): BelongsTo
    {
        return $this->belongsTo(SubCounty::class)->with('county');
    }

    /**
     * STATIC FUNCTIONS
     */
    public static function deliveryAddresses() {
        return self::where('user_id', Auth::id())->with('subCounty')->get()->toArray();
    }
}
