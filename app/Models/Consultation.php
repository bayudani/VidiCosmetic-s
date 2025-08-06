<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    //
    protected $fillable = [
        'user_id',
        'scheduled_at',
        'status',
        'notes',
    ];
    protected $casts = [
        'scheduled_at' => 'datetime',
        'status' => 'string',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
