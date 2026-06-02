<?php
use Illuminate\Support\Facades\Route;

class AuthRoutes {
    public static function routes(){
        Route::post('/login');
    }
}