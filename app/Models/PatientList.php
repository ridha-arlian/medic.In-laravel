<?php

namespace App\Models;

use App\Models\MedicineStock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Omaressaouaf\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientList extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'patients';

    protected $fillable = [
        'medical_record_number',
        'nik',
        'full_name',
        'date_of_birth',
        'gender',
        'address',
        'phone_number',
        'blood_type',
        'medical_history',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($patient) {
            $date = now()->format('Ymd');
            $patient->medical_record_number = IdGenerator::generate(
                self::class,
                'medical_record_number',
                4,
                "MR-{$date}-"
            );
        });
    }

    public function medicineAllergies()
    {
        return $this->belongsToMany(
            MedicineStock::class,
            'patient_drug_allergies',
            'patients_id',
            'medicine_stock_id'
        )->withPivot('custom_medicine_name', 'reaction')
         ->withTimestamps();
    }

    public function drugAllergies()
    {
        return $this->hasMany(PatientDrugAllergy::class, 'patients_id');
    }

    public function isAllergicTo(int $medicineId): bool
    {
        $medicine = MedicineStock::find($medicineId);
        
        if (!$medicine) {
            return false;
        }

        return $this->drugAllergies()
            ->where(function($query) use ($medicineId, $medicine) {
                $query->where('medicine_stock_id', $medicineId)
                    ->orWhere(function($subQuery) use ($medicine) {
                        $subQuery->whereNull('medicine_stock_id')
                            ->where('custom_medicine_name', 'LIKE', "%{$medicine->name}%");
                    });
            })
            ->exists();
    }

    public function getAllergyDetails(int $medicineId): ?array
    {
        $medicine = \App\Models\MedicineStock::find($medicineId);
        
        if (!$medicine) {
            return null;
        }

        $allergy = $this->drugAllergies()
            ->where(function($query) use ($medicineId, $medicine) {
                $query->where('medicine_stock_id', $medicineId)
                    ->orWhere(function($subQuery) use ($medicine) {
                        $subQuery->whereNull('medicine_stock_id')
                                ->where('custom_medicine_name', 'LIKE', "%{$medicine->name}%");
                    });
            })
            ->first();

        if (!$allergy) {
            return null;
        }

        return [
            'medicine' => $allergy->medicine_stock_id 
                ? $allergy->medicineStock->name 
                : $allergy->custom_medicine_name,
            'reaction' => $allergy->reaction,
            'recorded_at' => $allergy->created_at->format('d M Y'),
        ];
    }

    /**
     * Get patient's age
     */
    public function getAgeAttribute(): int
    {
        return $this->date_of_birth->age;
    }

    public function getAllergyMedicinesAttribute(): ?string
    {
        if ($this->relationLoaded('drugAllergies') && $this->drugAllergies->isNotEmpty()) {
            return $this->drugAllergies
                ->map(fn ($a) => $a->medicine_name)
                ->filter()
                ->unique()
                ->join(', ');
        }

        return null;
    }

    public function getAllergyReactionsAttribute(): ?string
    {
        if ($this->relationLoaded('drugAllergies') && $this->drugAllergies->isNotEmpty()) {
            return $this->drugAllergies
                ->map(fn ($a) => $a->reaction)
                ->filter()
                ->unique()
                ->join(', ');
        }

        return null;
    }

    public function getAllergyDetailsListAttribute(): ?array
    {
        if ($this->relationLoaded('drugAllergies') && $this->drugAllergies->isNotEmpty()) {
            return $this->drugAllergies->map(function ($a) {
                $medicine = $a->medicine_stock_id && $a->medicineStock
                    ? $a->medicineStock->name
                    : $a->custom_medicine_name;

                return "{$medicine} — {$a->reaction}";
            })->filter()->unique()->values()->all();
        }

        return null;
    }

    /**
     * Check if patient has drug allergies
     */
    // public function hasDrugAllergies(): bool
    // {
    //     return !empty($this->drug_allergies);
    // }

    /**
     * Relationship: Patient has many medical visits
     */
    // public function visits()
    // {
    //     return $this->hasMany(Visit::class);
    // }

    /**
     * Relationship: Patient has many appointments
     */
    // public function appointments()
    // {
    //     return $this->hasMany(Appointment::class);
    // }

    /**
     * Scope: Active patients only
     */
    // public function scopeActive($query)
    // {
    //     return $query->where('is_active', true);
    // }

    /**
     * Scope: Search by name, NIK, or medical record number
     */
    // public function scopeSearch($query, $search)
    // {
    //     return $query->where(function ($q) use ($search) {
    //         $q->where('full_name', 'ilike', "%{$search}%")
    //           ->orWhere('nik', 'like', "%{$search}%")
    //           ->orWhere('medical_record_number', 'like', "%{$search}%");
    //     });
    // }
}
