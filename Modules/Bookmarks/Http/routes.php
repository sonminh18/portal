<?php

Route::group(['middleware' => 'web', 'prefix' => 'bookmarks', 'namespace' => 'Modules\Bookmarks\Http\Controllers'], function()
{
    Route::get('/', 'BookmarksController@index');
    Route::post('/ListJson', 'BookmarksController@ListJson');
    Route::get('/createbookmarks', 'BookmarksController@create');
});
