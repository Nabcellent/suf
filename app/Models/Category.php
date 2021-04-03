<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public function product(): HasMany {
        return $this->hasMany(Product::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(__CLASS__, 'section_id')
            ->where(['category_id' => null, 'status' => 1])
            ->with('subCategories');
    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(__CLASS__, 'category_id')->where('status', 1);
    }



    public static function sections(): mixed {
        $getCategories = self::where(['section_id' => null, 'category_id' => null])
            ->with('categories')->where('status', 1)->get();
        try {
            $getCategories = json_decode(json_encode($getCategories, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
            echo $e;
        }
        return $getCategories;
    }

    public static function categoryDetails($url): array
    {
        $categoryDetails = self::select('id', 'title')->with(['subCategories' => function($query) {
            $query->select('categories.category_id', 'categories.id', 'categories.section_id');
        }])->where('id', $url)->first()->toArray();

        $catIds = array();
        $catIds[] = $categoryDetails['id'];

        foreach($categoryDetails['sub_categories'] as $subCat) {
            $catIds[] = $subCat['id'];
        }

        return array('catIds' => $catIds, 'categoryDetails' => $categoryDetails);
        //dd($catId); die;
    }

    use HasFactory;
}
