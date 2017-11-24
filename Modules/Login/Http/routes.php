<?php

Route::group(['middleware' => 'usersession', 'prefix' => 'login', 'namespace' => 'Modules\Login\Http\Controllers'], function()
{
//    Route::post('/signin', 'LoginController@signin');
//    Route::post('/signout', 'LoginController@signout');
//    Route::post('/changepass', 'LoginController@changepassword');
});
