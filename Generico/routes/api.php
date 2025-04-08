<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', fn () => ['user' => auth()->user()]);
});

Route::middleware(['auth:sanctum', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/users', fn () => \App\Models\User::all());
});