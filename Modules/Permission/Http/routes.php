<?php

Route::group(['middleware' => 'usersession', 'prefix' => 'permission', 'namespace' => 'Modules\Permission\Http\Controllers'], function()
{
    Route::get('/', 'PermissionController@index');
});
