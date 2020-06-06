<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/foo', function () {
    return view('foo.index');
    //return view('foo/index'); it's the same
});

// Route::get('/product/{id}', function ($id) {
//     echo $id;
// });

// Route::group(['prefix' => 'product'], function () {
//     $name = "asd";
//     Route::get('/', function () use($name){
//         echo 'index'.$name;
//     })->name('indexProduct');

//     Route::get('/{id}', function ($id) {
//         echo $id;
//     })->where('id','[0-9]+');
// });

Route::group([
    'prefix' => 'product',
    'namespace' => 'Product'
], function () {
    $name = "asd";
    Route::get('/', 'ProductController@index')->name('indexProduct');

    // Route::get('/{id}', function ($id) {
    //     echo $id;
    // })->where('id','[0-9]+');

    Route::get('/foo', 'ProductController@create');

    Route::post('/create', 'ProductController@store')->name('post_product');
    Route::delete('/delete/{id}', 'ProductController@destroy');
    Route::get('{id}', 'ProductController@show');
    Route::get('/type/{id}/{search}', 'ProductTypeController@show');
});
Route::group([
    'prefix' => 'auth',
    'namespace' => 'MyAuth',
    'middleware' => 'guest',
], function () {
    Route::get('/login', 'LoginController@index')->middleware('guest');
    Route::post('/login', 'LoginController@login');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Route::middleware('student')->group(function(){
//     Route::group(['namespace' => 'MyAuth'], function () {
//         Route::get('/profile', 'ProfileController@index')->middleware('auth');
//         Route::post('/profile', 'ProfileController@update');
        
//     });
// });



Route::group([
    'middleware' => 'role:admin',
    'namespace' => 'MyAuth'
], function () {
    Route::get('/student', 'ProfileController@student');    
});

Route::group([
    'middleware' => 'role:student:admin',
    'namespace' => 'MyAuth'
], function () {
    Route::get('/profile', 'ProfileController@index')->middleware('auth');
    Route::post('/profile', 'ProfileController@update');
});

Route::group([
    'namespace' => 'MyAuth'
], function () {
    Route::get('/profile/{id}', 'ProfileController@profile')->middleware('auth');
    Route::post('/profile/{id}', 'ProfileController@updateProfile')->middleware('auth');
});