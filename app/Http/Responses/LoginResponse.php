<?php

// namespace App\Http\Responses;

// use Filament\Pages\Dashboard;
// use Filament\Facades\Filament;
// use Illuminate\Http\RedirectResponse;
// use Livewire\Features\SupportRedirects\Redirector;
// use Filament\Auth\Http\Responses\Contracts\LoginResponse as LoginResponseContract;

// class LoginResponse implements LoginResponseContract
// {
//     public function toResponse($request): RedirectResponse | Redirector
//     {
//         $user = auth()->user();
        
//         if ($user->is_admin){
//             return redirect()->to('');
//         } elseif ($user->is_apoteker){
//             return redirect()->to('/apoteker');
//         } elseif ($user->is_dokter){
//             return redirect()->to('/dokter');
//         }
        
//         return redirect()->intended(Filament::getUrl());
//     }
// }