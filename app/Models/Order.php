<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'order_status',
        'payment_status',
        'payment_method',
        'shipping_address',
        'delivery_method',
        'proof_of_transaction',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items associated with the order.
     */
    public function items()
    {
        return $this->hasMany(Order_item::class);
    }
}
