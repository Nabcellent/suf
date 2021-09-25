<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'user_type',
        'email',
        'password',
        'ip_address',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function admin(): HasOne {
        return $this->hasOne(Admin::class);
    }

    public function addresses(): HasMany {
        return $this->hasMany(Address::class)->with('subCounty');
    }

    public function phones(): hasMany {
        return $this->hasMany(Phone::class)->orderByDesc('primary');
    }

    public function primaryPhone(): hasOne {
        return $this->hasOne(Phone::class)->where('primary', 1);
    }

    public function products(): HasMany {
        return $this->hasMany(Product::class, 'seller_id');
    }

    public function orders(): HasMany {
        return $this->hasMany(Order::class);
    }


    /**
     * STATIC FUNCTIONS
     */
    public static function getCustomers(): Builder|User {
        return self::where('is_admin', 0)->with('phones', 'primaryPhone')->withCount('orders');
    }
}
