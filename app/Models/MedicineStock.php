<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Omaressaouaf\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicineStock extends Model
{
    protected $fillable = ['medicine_stocks_id', 'name', 'quantity', 'price', 'batch_id', 'expired_date', 'medicine_types_id', 'medicine_categories_id', 'medicine_suppliers_id'];
    
    public function medicine_types(): BelongsTo
    {
        return $this->belongsTo(MedicineType::class);
    }

    public function medicine_categories(): BelongsTo
    {
        return $this->belongsTo(MedicineCategory::class);
    }

    public function medicine_suppliers(): BelongsTo
    {
        return $this->belongsTo(MedicineSupplier::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->medicine_stocks_id = IdGenerator::generate(
                self::class,
                'medicine_stocks_id',
                5,
                'MED-'
            );
        });
    }
}
