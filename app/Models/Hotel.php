<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stars',
        'country',
        'city',
        'open_year',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
