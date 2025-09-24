<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicineSupplier extends Model
{
    protected $fillable = ['name', 'contact_person', 'phone', 'email', 'address', 'status'];

    public function medicineStocks(): HasMany
    {
        return $this->hasMany(MedicineStock::class, 'medicine_suppliers_id');
    }
}
