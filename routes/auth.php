<?php

Route::post('login', 'LoginController@index');
Route::post('logout', 'LogoutController@index')->middleware("auth:sanctum");
Route::post('register', 'RegisterController@index');
