<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'bank_name',
        'account_number',
        'account_name',
    ];

    /**
     * Get the bank account's details as a formatted string.
     *
     * @return string
     */
    public function getDetailsAttribute()
    {
        return "{$this->bank_name} - {$this->account_number} ({$this->account_name})";
    }
}
