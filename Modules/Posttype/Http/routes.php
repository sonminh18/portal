<?php

Route::group(['middleware' => 'usersession', 'prefix' => 'posttype', 'namespace' => 'Modules\Posttype\Http\Controllers'], function()
{
    Route::get('/', 'PosttypeController@index');
    Route::post('/ListJson', 'PosttypeController@ListJson');
    Route::post('/create', 'PosttypeController@create');
    Route::post('/edit', 'PosttypeController@edit');
    Route::post('/save', 'PosttypeController@savePostType');
    Route::post('/delete', 'PosttypeController@delete');
    Route::post('/update', 'PosttypeController@update');
});
