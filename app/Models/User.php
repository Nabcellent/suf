<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'ip_address'
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
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class)->with('subCounty');
    }

    public function phones(): MorphMany {
        return $this->morphMany(Phone::class, 'phoneable')->orderByDesc('primary');
    }

    public function primaryPhone(): MorphOne {
        return $this->morphOne(Phone::class, 'phoneable')->where('primary', 1);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }


    /**
     * STATIC FUNCTIONS
     */
}
