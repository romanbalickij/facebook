<?php

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Route;


Auth::routes();


Route::get('{any}', 'AppController@index')
    ->where('any','.*')
    ->middleware('auth')
    ->name('home');


//Route::get('/deb', function (){
//
//$ss =  PostResource::collection(\App\User::find(1)->posts);
//    return $ss;
//dd($ss);exit();
//});
