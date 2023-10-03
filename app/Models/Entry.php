<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;
    protected $fillable = [
        'license_plate',
        'make',
        'model',
        'color',
        'vehicle_type',
        'entry_time',
        'parking_spot_number',
        'entry_status',
        'driver_name',
        'driver_phone',
        'rate_type',
        'current_rate',
        'notes',
        'images'
    ];

}
