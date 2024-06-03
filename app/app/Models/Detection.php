<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detection extends Model
{
    use HasFactory;

    protected $fillable = [
        'sensor_data',
        'sensor_1',
        'sensor_2',
        'sensor_3',
        'sensor_4',
        'status',
        'remarks',
    ];
}
