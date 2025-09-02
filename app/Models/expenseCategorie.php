<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class expenseCategorie extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];
    public function expenses()
    {
        return $this->hasMany(Expense::class, 'expense_category_id');
    }
}
