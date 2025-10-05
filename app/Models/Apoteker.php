<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Apoteker extends Model
{
    // use SoftDeletes;

    protected $fillable = [
        'user_id',
        'stra_number',
        'phone_number',
        'address',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::deleting(function ($apoteker) {
            $apoteker->user()->delete();
        });
    }
}