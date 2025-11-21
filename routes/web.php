<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KonsultasiController;
use App\Livewire\Ongoing;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('/layanan', function () {
    return view('layanan');
})->name('layanan');

Route::get('/portofolio', function () {
    return view('portofolio');
})->name('portofolio');

// Route::get('/artikel', function () {
//     return view('artikel');
// })->name('artikel');

Route::get('/proyek', function () {
    return view('proyek');
})->name('proyek');

Route::get('/tentang-kami', function () {
    return view('tentang-kami');
})->name('tentang-kami');

Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi');
Route::post('/konsultasi', [KonsultasiController::class, 'store'])->name('konsultasi.store');
Volt::route('artikel/{slug}', 'artikel.detail')->name('artikel.detail');
Volt::route('artikel', 'artikel')->name('artikel');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::redirect('settings', 'settings/profile');

//     Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
//     Volt::route('settings/password', 'settings.password')->name('user-password.edit');
//     Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

//     Volt::route('settings/two-factor', 'settings.two-factor')
//         ->middleware(
//             when(
//                 Features::canManageTwoFactorAuthentication()
//                     && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
//                 ['password.confirm'],
//                 [],
//             ),
//         )
//         ->name('two-factor.show');
// });
