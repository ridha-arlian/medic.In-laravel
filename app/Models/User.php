<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Panel;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
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

    public function canAccessPanel(Panel $panel): bool
    {
        // return str_ends_with($this->email, '@example.com') && $this->hasVerifiedEmail();
        return true;
    }

    public function canImpersonate(): bool
    {
        // Let's prevent impersonating other users at our own company
        // example:
        // return $this->email === 'superadmin@example.com';
        return true;
    }

    public function canBeImpersonated(): bool
    {
        // Let's prevent being impersonated by other users at our own company
        // example:
        // return $this->email === 'member@example.com';
        return true;
    }

}