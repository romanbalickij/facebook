<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group( function () {

    Route::post('/posts', "PostController@store");
    Route::get('/posts', 'PostController@index');
});
