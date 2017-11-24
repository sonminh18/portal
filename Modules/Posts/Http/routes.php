<?php

Route::group(['middleware' => 'usersession', 'prefix' => 'posts', 'namespace' => 'Modules\Posts\Http\Controllers'], function()
{
    Route::get('/', 'PostsController@index');
    Route::get('/create', 'PostsController@create');
    Route::post('/ListJson', 'PostsController@ListJson');
    Route::post('/popupedit', 'PostsController@popupedit');
});
