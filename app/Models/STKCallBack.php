<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class STKCallBack extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'push_id',
        'amount',
        'receipt_number',
        'status',
    ];

    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function STKPush():BelongsTo {
        return $this->belongsTo(STKPush::class);
    }



    /**
     * STATIC FUNCTIONS
     */
}
