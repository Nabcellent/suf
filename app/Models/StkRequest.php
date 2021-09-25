<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin IdeHelperStkRequest
 */
class StkRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function response(): HasOne {
        return $this->hasOne(StkCallback::class, 'checkout_request_id', 'checkout_request_id');
    }



    /**
     * STATIC FUNCTIONS
     */
}
