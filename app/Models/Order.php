<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'address_id',
        'phone_id',
        'coupon_id',
        'coupon_discount',
        'payment_type',
        'payment_method',
        'total'
    ];

    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrdersProduct::class)->with('product');
    }

    public function phone(): BelongsTo
    {
        return $this->belongsTo(Phone::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class)->with('subCounty');
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }



    /**
     * STATIC FUNCTIONS
     */
    public static function usersOrders() {
        return self::where('user_id', Auth::id())->with('orderProducts');
    }
}
