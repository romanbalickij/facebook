<?php

use App\Http\Resources\LikeResource;
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
//
//
//
//    //return auth()->user()->likedPosts()->where('post_id',1)->count();
//$ss =  LikeResource::collection(\App\Post::find(1)->likes);
//    return $ss;
//dd($ss);exit();
//});
