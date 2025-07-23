<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\OrderController;

Route::get('/menus', [MenuController::class, 'index']);
Route::get('/orders', [OrderController::class, 'index']);
