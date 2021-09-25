<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tonysm\RichTextLaravel\Casts\AsRichTextContent;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

/**
 * @mixin IdeHelperCmsPage
 */
class CmsPage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'url',
        'description',
        'meta_title',
        'meta_desc',
        'meta_keywords',
    ];

    protected $casts = [
        'description' => AsRichTextContent::class,
        'meta_desc' => AsRichTextContent::class,
    ];
}
