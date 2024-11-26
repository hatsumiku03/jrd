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
    Route::get('/perfectmanagement', function () {
        return view('management');
    })->name('management');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    \App\Http\Middleware\Roles::class
])->group(function () {
    Route::get('/management/penyas', function () {
        return view('crewsg');
    })->name('penyas');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    \App\Http\Middleware\Roles::class
])->group(function () {
    Route::get('/management/users', function () {
        return view('usersg');
    })->name('users');;
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});