<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Store_galery extends Model
{
    use HasFactory;
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
