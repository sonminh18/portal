<?php

Route::group(['middleware' => 'web', 'prefix' => 'posttype', 'namespace' => 'Modules\Posttype\Http\Controllers'], function()
{
    Route::get('/', 'PosttypeController@index');
    Route::post('/ListJson', 'PosttypeController@ListJson');
    Route::post('/create', 'PosttypeController@create');
    Route::post('/edit', 'PosttypeController@edit');
    Route::post('/save', 'PosttypeController@savePostType');
});
