<?php

Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::get('/permission', 'AdminController@index');
    Route::post('/ListJsonModule', 'AdminController@ListJsonModule');
    Route::post('/popupmodule', 'AdminController@popupmodule');
});
