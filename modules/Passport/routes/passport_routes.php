<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Modules\Passport\Controllers', 'prefix' => 'api/v1/'], function () {
    Route::post('login', 'PassportController@postLogin')->name("passport.login");
    Route::post('register', 'PassportController@postRegister')->name("passport.register");
});