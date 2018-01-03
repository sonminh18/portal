<?php

Route::group(['middleware' => 'usersession', 'prefix' => 'posts', 'namespace' => 'Modules\Posts\Http\Controllers'], function()
{
    Route::get('/index', 'PostsController@index');
    Route::get('/create', 'PostsController@create');
    Route::post('/ListJson', 'PostsController@ListJson');
    Route::post('/popupedit', 'PostsController@popupedit');
    Route::post('/savepost', 'PostsController@savepost');
    Route::get('/edit/{id}', 'PostsController@edit');
    Route::post('/updatepost', 'PostsController@updatepost');
    Route::post('/deletepost', 'PostsController@deletepost');
});
