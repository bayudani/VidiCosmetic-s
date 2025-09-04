<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class OwnerProfile extends Model
{
    use HasFactory;
    protected $table = 'owner_profiles';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'photo',
        'quotes',
    ];
}
