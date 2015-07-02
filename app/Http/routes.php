<?php
Route::get('/', function () {
    return view('welcome');
});

//Route::controller('login', 'Auth\AuthController');
Route::get('logout', 'Auth\AuthController@getLogout');

Route::group(['namespace' => 'Api', 'prefix' => 'api', 'middleware' => 'resource'],
    function () {
        Route::resource('customers', 'CustomersController');
    }
);