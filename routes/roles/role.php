<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\TokenIsValid;

Route::get('/',[RoleController::class, 'index']);
Route::post('/', [RoleController::class, 'store']);
Route::post('/{id}', [RoleController::class, 'update']);
Route::delete('/{id}',[RoleController::class, 'destroy']);