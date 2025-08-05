<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'price', 'stock', 'description', 'category_id'];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the images associated with the product.
     */
    public function images()
    {
        return $this->hasMany(Product_image::class);
    }
    /**
     * Get the cart items associated with the product.
     */
    public function cartItems()
    {
        return $this->hasMany(Cart_item::class);
    }
}
