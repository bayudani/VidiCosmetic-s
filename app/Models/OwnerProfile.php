<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OwnerProfile extends Model
{
    protected $table = 'owner_profiles';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'photo',
    ];
}
