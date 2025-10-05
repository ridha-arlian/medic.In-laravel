<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokter extends Model
{
    // use SoftDeletes;

    protected $fillable = [
        'user_id',
        'str_number',
        'specialization_id',
        'phone_number',
        'address',
        'consultation_fee',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function specialization(): BelongsTo
    {
        return $this->belongsTo(Specialization::class);
    }

    // public function patients(): HasMany
    // {
    //     return $this->hasMany(Patient::class);
    // }

    // public function prescriptions(): HasMany
    // {
    //     return $this->hasMany(Prescription::class);
    // }

    // // Accessor untuk statistik
    // public function getTotalPatientsAttribute(): int
    // {
    //     return $this->patients()->distinct('patient_id')->count();
    // }

    // public function getTotalPrescriptionsAttribute(): int
    // {
    //     return $this->prescriptions()->count();
    // }
}