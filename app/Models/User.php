<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [ 'name', 'email', 'password' ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // /**
    //  * Check if user is admin
    //  */
    // public function getIsAdminAttribute(): bool
    // {
    //     return $this->role === self::ADMIN_ROLE;
    // }

    // /**
    //  * Check if user is apoteker
    //  */
    // public function getIsApotekerAttribute(): bool
    // {
    //     return $this->role === self::APOTEKER_ROLE;
    // }

    // /**
    //  * Check if user is dokter
    //  */
    // public function getIsDokterAttribute(): bool
    // {
    //     return $this->role === self::DOKTER_ROLE;
    // }

    // /**
    //  * Scope for admin
    //  */
    // public function scopeAdmins($query)
    // {
    //     return $query->where('role', self::ADMIN_ROLE);
    // }

    // /**
    //  * Scope for apoteker
    //  */
    // public function scopeApotekers($query)
    // {
    //     return $query->where('role', self::APOTEKER_ROLE);
    // }

    // /**
    //  * Scope for dokter
    //  */
    // public function scopeDokters($query)
    // {
    //     return $query->where('role', self::DOKTER_ROLE);
    // }
}