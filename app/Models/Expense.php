<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Expense extends Model
{
    Use HasFactory;
    protected $fillable = [
        'description',
        'amount',
        'expense_date',
        'expense_category_id',
    ];

    protected $casts = [
        'expense_date' => 'date',
    ];
    public function category()
    {
        return $this->belongsTo(expenseCategorie::class, 'expense_category_id');
    }
}
