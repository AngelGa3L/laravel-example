<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/users')->group(function (){
    require ('user/user.php');
});

Route::prefix('/auth')->group(function (){
    require ('auth/auth.php');
});

Route::prefix('/roles')->group(function () {
    require ('roles/role.php');
});