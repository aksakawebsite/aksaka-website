<?php

namespace App\Http\Responses;

use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse implements LoginResponseContract
{
    public function __construct() {}

    public function toResponse($request): RedirectResponse|Redirector
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->to('/admin');
        }

        if ($user->isMember()) {
            return redirect()->to('/member');
        }

        return redirect()->to('/');
    }
}
