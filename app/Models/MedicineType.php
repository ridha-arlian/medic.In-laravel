<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicineType extends Model
{
    protected $fillable = ['name', 'code', 'description', 'status'];

    public function medicineStocks(): HasMany
    {
        return $this->hasMany(MedicineStock::class, 'medicine_types_id');
    }
}
