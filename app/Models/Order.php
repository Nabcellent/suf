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

    public function orderProducts(): HasMany
    {
        $orderProducts = $this->hasMany(OrdersProduct::class);

        if(isSeller()) {
            $orderProducts->whereHas('product', function($query) {
                $query->where('seller_id', Auth::id());
            })->with(['product' => function($query) {
                $query->where('seller_id', Auth::id());
            }]);
        } else {
            $orderProducts->with('product');
        }

        return $orderProducts;
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
    public static function orders() {
        return self::with('user', 'orderProducts', 'phone');
    }
    public static function usersOrders() {
        return self::where('user_id', Auth::id())->with('orderProducts');
    }
    public static function getSellerOrders() {
        return self::whereHas('sellersOrders')->with('sellersOrders', 'user', 'phone');
    }
}
