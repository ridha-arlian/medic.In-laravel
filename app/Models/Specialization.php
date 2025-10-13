<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Omaressaouaf\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Specialization extends Model
{
    protected $fillable = ['name', 'description', 'code', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function dokter(): HasOne
    {
        return $this->hasOne(Dokter::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->code = IdGenerator::generate(
                self::class,
                'code',
                5,
                'SP-'
            );
        });
    }
}