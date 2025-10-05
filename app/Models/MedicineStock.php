<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Omaressaouaf\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $medicine_stocks_id
 * @property string $name
 * @property int $quantity
 * @property int $price
 * @property string $batch_id
 * @property string $expired_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $medicine_types_id
 * @property int|null $medicine_categories_id
 * @property int|null $medicine_suppliers_id
 * @property-read \App\Models\MedicineCategory|null $medicine_categories
 * @property-read \App\Models\MedicineSupplier|null $medicine_suppliers
 * @property-read \App\Models\MedicineType|null $medicine_types
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineStock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineStock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineStock query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineStock whereBatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineStock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineStock whereExpiredDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineStock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineStock whereMedicineCategoriesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineStock whereMedicineStocksId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineStock whereMedicineSuppliersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineStock whereMedicineTypesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineStock whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineStock wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineStock whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineStock whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
