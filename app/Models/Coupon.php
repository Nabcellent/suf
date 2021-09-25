<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperCoupon
 */
class Coupon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'option',
        'code',
        'categories',
        'users',
        'coupon_type',
        'amount_type',
        'amount',
        'expiry',
    ];

    /**
     * RELATIONSHIP FUNCTIONS
     */



    /**
     * STATIC FUNCTIONS
     */
}
