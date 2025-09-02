<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\CartItemFactory;
use Illuminate\Database\Eloquent\Factories\Factory; 

class Cart_item extends Model
{
    use HasFactory;
    protected $table = 'cart_items';
    protected $fillable = ['user_id', 'product_id', 'quantity'];
    /**
     * Get the user that owns the cart item.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the product associated with the cart item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    protected static function newFactory(): Factory
    {
        return CartItemFactory::new();
    }
}
