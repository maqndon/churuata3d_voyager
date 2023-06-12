<?php

use TCG\Voyager\Facades\Voyager;
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
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

//Routes for the menu items created with VoyagerMenuServiceProvider
$routes = [
    'products',
    'posts',
    'pages'
];

foreach ($routes as $route) {
    Route::get("/" . $route, function () use ($route){
        return "This is the $route page";
    })->name($route);
}