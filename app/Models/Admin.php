<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @mixin IdeHelperAdmin
 */
class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected string $guard = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'national_id',
        'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pin',
    ];



    /**
     * RELATIONSHIP FUNCTIONS
     */

    public function user(): belongsTo {
        return $this->belongsTo(User::class)
            ->with('products')->withCount('products', 'orders')->with('primaryPhone');
    }


    /**
     * STATIC FUNCTIONS
     */
    public static function getSellers() {
        return self::where('type', 'Seller')->with('user');
    }

    public static function getAdmins() {
        return self::where('type', 'Super')->with('user');
    }
}
