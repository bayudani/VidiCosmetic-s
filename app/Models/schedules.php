<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class schedules extends Model
{
    use HasFactory;
    protected $table = 'schedules';

    protected $fillable = [
        'day_of_week',
        'start_time',
        'end_time',
        'is_active',
    ];

}
