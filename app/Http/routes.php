<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * PORTFOLIO
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
Route::get('portfolio', 'Portfolio_Controller@index');
Route::get('/portfolio/{type}', 'Portfolio_Controller@index');

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * PORTFOLIO > SHOW AND TELL
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
Route::group(['prefix' => 'show_tell'], function () {
    Route::get('/', 'Show_Tell_Controller@index');
    Route::get('/dashboard', 'Show_Tell_Controller@dashboard');
    Route::get('/dashboard/{page}', 'Show_Tell_Controller@dashboard');

    Route::any('/login', 'Show_Tell_Controller@login');
    Route::any('/logout', 'Show_Tell_Controller@logout');
    Route::any('/reset', 'Show_Tell_Controller@reset');

    Route::any('/update_info', 'Show_Tell_Controller@profile');
    Route::any('/update_password', 'Show_Tell_Controller@password');
    Route::any('/submit_image', 'Show_Tell_Controller@submit');

    Route::any('/image_accept/{intImgId}', 'Show_Tell_Controller@image_accept');
    Route::any('/image_deny/{intImgId}', 'Show_Tell_Controller@image_deny');

    Route::any('/ajax_removeImage', 'Show_Tell_Controller@ajax_removeImage');
    Route::any('/ajax_getUserData', 'Show_Tell_Controller@ajax_getUserData');
    Route::any('/ajax_getImageData', 'Show_Tell_Controller@ajax_getImageData');
    Route::any('/ajax_submitComment', 'Show_Tell_Controller@ajax_submitComment');
});
