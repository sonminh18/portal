
<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','\Modules\Login\Http\Controllers\LoginController@index');
Route::post('/signin','\Modules\Login\Http\Controllers\LoginController@signin');
Route::get('/signout','\Modules\Login\Http\Controllers\LoginController@signout');
Route::post('/changepass','\Modules\Login\Http\Controllers\LoginController@changepassword');

Route::get('/setup',function (){
    \Illuminate\Support\Facades\Artisan::call('clear-compiled');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('dump-autoload');
    dd(\Illuminate\Support\Facades\Artisan::output());
});
Route::get('/clearsesssion',function (){
    session()->flush();
    session()->regenerate();
});
