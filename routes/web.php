<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Tasks;
use App\Http\Controllers\TaskController;


Route::get('/', function () {
    return view('welcome');
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/tasks', function () {
        return view('tasks');
    })->name('tasks');
});


    

