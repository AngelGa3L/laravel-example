<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::use('/users', UserRoutes::class);
Route::use('/auth', AuthRoutes::class);