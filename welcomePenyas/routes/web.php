<?php

use App\Http\Controllers\Api\DrawController;
use App\Livewire\AdministratorPanel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/rifada-padre', function () {
    return view('user-draw');
})->name('draw');

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

Route::get('/draw-results', [DrawController::class, 'drawData'])->name('draw.results');