<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store_galery extends Model
{
    protected $fillable = ['media_path', 'media_type'];

    /**
     * Get the media type of the store gallery.
     */
    // public function getMediaTypeAttribute($value)
    // {
    //     return $value;
    // }

    // /**
    //  * Get the media path of the store gallery.
    //  */
    // public function getMediaPathAttribute($value)
    // {
    //     return $value;
    // }
}
