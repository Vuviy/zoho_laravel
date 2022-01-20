<?php

//use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
//use Symfony\Component\HttpFoundation\Request;
use Illuminate\Http\Request;


//use App\Http\Controllers\Conti;



//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('home');
})->name('home');


Route::post('/authorization', 'App\Http\Controllers\AddDealController@authentication')->name('authorization');

Route::get('/deal', function () {
    return view('deal');
})->name('deal');

Route::post('/add-deal', 'App\Http\Controllers\AddDealController@second')->name('add-deal');


Route::get('/tusk', function () {
    return view('tusk');
})->name('add-tusk');
