<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class STKPush extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'phone',
        'merchant_request_id',
        'checkout_request_id',
    ];

    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function STKCallBack(): HasOne {
        return $this->hasOne(STKCallBack::class);
    }



    /**
     * STATIC FUNCTIONS
     */
}
