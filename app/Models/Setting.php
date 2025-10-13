<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'clinic_name',
        'clinic_address',
        'clinic_phone',
        'clinic_email',
        'clinic_logo',
        'opening_hours',
        'default_consultation_fee',
        'min_stock_alert_threshold',
    ];

    protected $casts = [
        'opening_hours' => 'array',
        'default_consultation_fee' => 'decimal:2',
        'min_stock_alert_threshold' => 'integer',
    ];
}
