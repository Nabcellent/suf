<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperBanner
 */
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
    public static function getBanners(): array {
        return [
            'sliders' => self::select('image', 'alt', 'title', 'description')
                ->where(['status' => 1, 'type' => 'Slider'])->get()->toArray(),
            'ads' => self::select('image', 'link', 'title', 'description', 'alt')
                ->where(['status' => 1, 'type' => 'Box'])->get()->toArray()
        ];
    }

    use HasFactory;
}
