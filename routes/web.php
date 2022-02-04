<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/authorization', 'App\Http\Controllers\AddDealController@authentication')->name('authorization');

Route::get('/deal', function () {
    return view('deal');
})->name('deal');

Route::post('/add-deal', 'App\Http\Controllers\AddDealController@addDeal')->name('add-deal');

Route::get('/finish_page', function () {
    return view('finish_page');
})->name('finish_page');
