<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

/**
 * @mixin IdeHelperOrder
 */
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
        'order_no',
        'phone',
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

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class)->with('subCounty');
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function orderProducts(): HasMany {
        return $this->hasMany(OrdersProduct::class)->with('product');
    }

    public function orderLogs(): HasMany {
        return $this->hasMany(OrdersLog::class);
    }

    public function sellersOrders(): HasMany
    {
        return $this->hasMany(OrdersProduct::class)->has('loggedSeller');
    }



    /**
     * STATIC FUNCTIONS
     */
    public static function orders(): Builder {
        return self::with('user', 'orderProducts');
    }
    public static function usersOrders(): Order|Builder {
        return self::where('user_id', Auth::id())->with('orderProducts');
    }
    public static function getSellerOrders(): Order|Builder {
        return self::whereHas('sellersOrders')->with('sellersOrders', 'user');
    }

    public static function orderProductsReady($orderId): bool {
        $orderCollection = collect(Order::find($orderId)->orderProducts()->get()->toArray());

        if($orderCollection->isEmpty()) {
            return false;
        }

        return $orderCollection->every(function($value) {
            return $value['is_ready'] === 1;
        });
    }
}
