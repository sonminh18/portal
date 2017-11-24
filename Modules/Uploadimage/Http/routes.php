<?php

Route::group(['middleware' => 'usersession', 'prefix' => 'uploadimage', 'namespace' => 'Modules\Uploadimage\Http\Controllers'], function()
{
    Route::get('/', 'UploadimageController@index');
    Route::get('/uploadpopup', 'UploadimageController@uploadpopup');
    Route::post('/storeimage', 'UploadimageController@StoreImageUpload');
    Route::post('/imagelist', 'UploadimageController@getImageList');
    Route::post('/deleteimage', 'UploadimageController@deleteImage');

});
