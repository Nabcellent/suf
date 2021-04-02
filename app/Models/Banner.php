<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public static function getBanners() {
        //dd($getBanners); die;
        return self::where('status', 1)->get()->toArray();
    }
    use HasFactory;
}
