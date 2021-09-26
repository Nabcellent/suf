<?php

use Tonysm\RichTextLaravel\Models\RichText;

return [
    /*
     |--------------------------------------------------------------------------
     | Rich Text Model
     |--------------------------------------------------------------------------
     |
     | When using the suggested database structure, all your Rich Text content will be
     | stored in the same Database table. All interactions with that table happens
     | using this Eloquent Model. You can override this if you really need to.
     |
     */
    'model' => RichText::class,
];
