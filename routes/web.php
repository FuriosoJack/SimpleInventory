<?php


Route::get('/',[
    'as' => 'index',
    'uses' => '\App\Http\Controllers\IndexController@index'
]);


Route::get('/shop',[
    'as' => 'shop',
    'uses' => '\App\Http\Controllers\IndexController@shop'
]);