<?php

use Illuminate\Support\Facades\Route;

Route::put('/update-laravel-window-size', \Tanthammar\LaravelWindowSize\LaravelWindowSizeController::class)
    ->middleware('web', 'throttle:15,1');
