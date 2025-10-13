<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientDrugAllergy extends Model
{
    use HasFactory;

    protected $fillable = [
        'patients_id',
        'medicine_stock_id',
        'custom_medicine_name',
        'reaction',
    ];

    /**
     * Relasi belongsTo dengan Patient
     */
    public function patient()
    {
        return $this->belongsTo(PatientList::class, 'patients_id');
    }

    /**
     * Relasi belongsTo dengan MedicineStock
     */
    public function medicineStock()
    {
        return $this->belongsTo(MedicineStock::class, 'medicine_stock_id');
    }

    /**
     * Accessor untuk mendapatkan nama obat (dari stock atau custom)
     */
    public function getMedicineNameAttribute()
    {
        if ($this->medicine_stock_id && $this->medicineStock) {
            return $this->medicineStock->name;
        }
        
        return $this->custom_medicine_name;
    }
}