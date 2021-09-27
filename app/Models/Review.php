<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tonysm\RichTextLaravel\Casts\AsRichTextContent;

/**
 * @mixin IdeHelperReview
 */
class Review extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'review' => AsRichTextContent::class,
    ];


    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
