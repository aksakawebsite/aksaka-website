<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('LandingPage');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/tailwind-demo', function () {
    return Inertia::render('TailwindDemo');
})->name('tailwind.demo');

Route::get('/test-navbar-react', function () {
    return Inertia::render('TestNavbar');
})->name('test.navbar');

require __DIR__ . '/settings.php';
