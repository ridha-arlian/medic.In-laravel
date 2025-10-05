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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineCategory whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MedicineCategory extends Model
{
    protected $fillable = ['name', 'code', 'description', 'status'];

    public function medicineStocks(): HasMany
    {
        return $this->hasMany(MedicineStock::class, 'medicine_categories_id');
    }
}