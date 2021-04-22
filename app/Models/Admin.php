<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected string $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'gender',
        'image',
        'national_id',
        'type',
        'ip_address',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'pin', 'remember_token',
    ];



    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function phones(): MorphMany {
        return $this->morphMany(Phone::class, 'phoneable')->orderByDesc('primary');
    }

    public function primaryPhone(): MorphOne {
        return $this->morphOne(Phone::class, 'phoneable')->where('primary', 1);
    }

    public function products(): HasMany {
        return $this->hasMany(Product::class, 'seller_id');
    }



    /**
     * STATIC FUNCTIONS
     */
    public static function sellers() {
        return self::where('type', 'Seller');
    }
}
