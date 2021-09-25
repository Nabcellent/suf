<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperPhone
 */
class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'primary',
    ];

    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * STATIC FUNCTIONS
     */
    public static function getPhones(): Builder {
        return self::with('user');
    }
}
