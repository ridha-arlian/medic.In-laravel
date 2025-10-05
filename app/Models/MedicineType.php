<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $code
 * @property string|null $description
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MedicineStock> $medicineStocks
 * @property-read int|null $medicine_stocks_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineType whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MedicineType extends Model
{
    protected $fillable = ['name', 'code', 'description', 'status'];

    public function medicineStocks(): HasMany
    {
        return $this->hasMany(MedicineStock::class, 'medicine_types_id');
    }
}
