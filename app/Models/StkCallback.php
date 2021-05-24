<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StkCallback extends Model
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
    public function request():BelongsTo {
        return $this->belongsTo(StkRequest::class, 'checkout_request_id', 'checkout_request_id');
    }



    /**
     * STATIC FUNCTIONS
     */
    public static function getAll(): Builder {
        return self::with('request');
    }
}
