<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'client_id',
        'type',
        'date',
        'time',
    ];

    public $timestamps = true;
    
}
