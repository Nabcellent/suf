<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperAttribute
 */
class Attribute extends Model
{
    use HasFactory;

    protected $guarded = [];



    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function Variations(): HasMany {
        return $this->hasMany(Variation::class);
    }



    /**
     * STATIC FUNCTIONS
     */
}
