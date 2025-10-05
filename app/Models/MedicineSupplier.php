<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $contact_person
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $address
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MedicineStock> $medicineStocks
 * @property-read int|null $medicine_stocks_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineSupplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineSupplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineSupplier query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineSupplier whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineSupplier whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineSupplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineSupplier whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineSupplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineSupplier whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineSupplier wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineSupplier whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicineSupplier whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MedicineSupplier extends Model
{
    protected $fillable = ['name', 'contact_person', 'phone', 'email', 'address', 'status'];

    public function medicineStocks(): HasMany
    {
        return $this->hasMany(MedicineStock::class, 'medicine_suppliers_id');
    }
}
