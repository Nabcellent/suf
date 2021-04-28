<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'title',
        'link',
        'alt',
        'description',
        'type'
    ];


    /**
     * RELATIONSHIP FUNCTIONS
     */



    /**
     * STATIC FUNCTIONS
     */
    public static function getBanners() {
        return [
            'sliders' => self::where(['status' => 1, 'type' => 'Slider'])->get()->toArray(),
            'ads' => self::where(['status' => 1, 'type' => 'Box'])->get()->toArray()
        ];
    }

    use HasFactory;
}
