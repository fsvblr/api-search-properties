<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/properties', function () {
    return view('properties.index');
});

Route::get('/properties/{property}', function ($property) {
    return 'Property with ID ' . $property;
});
