<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('products', [
        'tv' => ['Телевизор 1', 'Телевизор 2', 'Телевизор 3'],
        'dvd' => ['DVD 1', 'DVD 2', 'DVD 3']]);
});
