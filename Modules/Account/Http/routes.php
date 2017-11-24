<?php

Route::group(['middleware' => 'usersession', 'prefix' => 'account', 'namespace' => 'Modules\Account\Http\Controllers'], function()
{
    Route::get('/', 'AccountController@index');
    Route::get('/createuser', 'AccountController@createuser');
    Route::get('/manageuser', 'AccountController@manageuser');
    Route::post('/ListJson', 'AccountController@ListJson');
    Route::post('/disable', 'AccountController@DisableAccount');
    Route::post('/enable', 'AccountController@EnableAccount');
    Route::post('/getinfo', 'AccountController@getInfo');
    Route::post('/changeinfo', 'AccountController@ChangeInfo');
    Route::post('/addnewuser', 'AccountController@addnewuser');
});
