<?php

Route::group(['middleware' => 'usersession', 'prefix' => 'bookmarks', 'namespace' => 'Modules\Bookmarks\Http\Controllers'], function()
{
    Route::get('/index', 'BookmarksController@index');
    Route::post('/ListJson', 'BookmarksController@ListJson');
    Route::get('/create', 'BookmarksController@create');
    Route::post('/save', 'BookmarksController@save');
    Route::post('/delete', 'BookmarksController@delete');
    Route::get('/edit/{id}', 'BookmarksController@edit');
    Route::post('/update', 'BookmarksController@update');
});
