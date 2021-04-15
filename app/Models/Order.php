<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrdersProduct::class);
    }



    /**
     * STATIC FUNCTIONS
     */
    public static function usersOrders() {
        return self::where('user_id', Auth::id())->with('orderProducts');
    }
}
