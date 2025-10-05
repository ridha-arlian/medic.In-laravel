<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;

class AppServiceProvider extends ServiceProvider
{    
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    protected $policies = [
        //
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        };

        Event::listen(Attempting::class, function ($event) {
            $email = $event->credentials['email'] ?? null;
            
            if ($email) {
                $user = User::where('email', $email)->first();
                
                if ($user && !$user->is_active) {
                    throw ValidationException::withMessages([
                        'data.email' => 'Akun Anda telah dinonaktifkan. Silakan hubungi administrator.',
                    ]);
                }
            }
        });
    }
}