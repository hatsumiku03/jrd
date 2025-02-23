<?php

use App\Livewire\AdministratorPanel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    \App\Http\Middleware\Roles::class
])->group(function () {
    Route::get('/management', function () {
        return view('management');
    })->name('management');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    \App\Http\Middleware\Roles::class
])->group(function () {
    Route::get('/sorteo', function () {
        return view('raffle');
    })->name('raffle');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
//     \App\Http\Middleware\Roles::class
// ])->group(function () {
//     Route::get('/incidencias', function () {
//         return view('incidents');
//     })->name('incidents');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});