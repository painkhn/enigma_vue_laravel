<?php

use App\Http\Controllers\{ CategoryController, ThemeController };
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/categories', [CategoryController::class, 'index']);
Route::apiResource('themes', ThemeController::class);