<?php

Route::group(['middleware' => 'web', 'prefix' => 'shortcut', 'namespace' => 'Modules\Shortcut\Http\Controllers'], function()
{
    Route::get('/', 'ShortcutController@index');
});
