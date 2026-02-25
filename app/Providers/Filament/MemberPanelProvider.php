<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class MemberPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('member')
            ->path('member')
            ->login()
            ->registration()
            ->passwordReset()
            ->brandName('Aksaka Member')
            ->brandLogo(asset('image/navbar/logo-aksaka.png'))
            ->darkModeBrandLogo(asset('image/navbar/logo-aksaka.png'))
            ->brandLogoHeight('4rem')
            ->favicon(asset('favicon.svg'))
            ->colors([
                'primary' => Color::Amber,
                'danger' => Color::Rose,
                'gray' => Color::Zinc,
                'info' => Color::Sky,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->darkMode(true)
            ->font('Inter')
            ->renderHook(
                PanelsRenderHook::STYLES_AFTER,
                fn (): string => Blade::render('@vite("resources/css/filament-auth.css")')
            )
            ->renderHook(
                PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE,
                fn (): string => Blade::render('
                    <div class="auth-custom-header">
                        <h2>👋 Selamat Datang!</h2>
                        <p>Masuk ke akun member Aksaka kamu</p>
                    </div>
                ')
            )
            ->renderHook(
                PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
                fn (): string => Blade::render('
                    <div class="auth-custom-footer">
                        <div class="auth-divider">
                            <span>atau</span>
                        </div>
                        <div class="text-center">
                            <a href="/" class="auth-back-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                                Kembali ke Beranda
                            </a>
                        </div>
                        <p class="auth-copyright">
                            © {{ date("Y") }} Aksaka. Hak Cipta Dilindungi.
                        </p>
                    </div>
                ')
            )
            ->renderHook(
                PanelsRenderHook::AUTH_REGISTER_FORM_BEFORE,
                fn (): string => Blade::render('
                    <div class="auth-custom-header">
                        <h2>🚀 Daftar Sekarang</h2>
                        <p>Buat akun untuk memulai perjalanan belajarmu</p>
                    </div>
                ')
            )
            ->renderHook(
                PanelsRenderHook::AUTH_REGISTER_FORM_AFTER,
                fn (): string => Blade::render('
                    <div class="auth-custom-footer">
                        <div class="text-center">
                            <a href="/" class="auth-back-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                                Kembali ke Beranda
                            </a>
                        </div>
                        <p class="auth-copyright">
                            © {{ date("Y") }} Aksaka. Hak Cipta Dilindungi.
                        </p>
                    </div>
                ')
            )
            ->renderHook(
                PanelsRenderHook::AUTH_PASSWORD_RESET_REQUEST_FORM_BEFORE,
                fn (): string => Blade::render('
                    <div class="auth-custom-header">
                        <h2>🔑 Lupa Password?</h2>
                        <p>Masukkan email untuk reset password</p>
                    </div>
                ')
            )
            ->discoverResources(in: app_path('Filament/Member/Resources'), for: 'App\Filament\Member\Resources')
            ->discoverPages(in: app_path('Filament/Member/Pages'), for: 'App\Filament\Member\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Member/Widgets'), for: 'App\Filament\Member\Widgets')
            ->widgets([
                \App\Filament\Member\Widgets\MemberStatsWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
