<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Modules\Dashboard\Entities\userslist;
use Modules\Permission\Http\Controllers\PermissionChecker as permission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        view()->composer('*',function ($view){
            $userslist = new userslist;
            $data=$userslist->where('username','=',session('username'))->first();
            $menu=$this->createMenu();
            $view->with([
                'data' => $data,
                'menu' => $menu
            ]);
        });
    }
    /**
     * Function tạo menu
     * @Kiểm tra OU của user đăng nhập
     */
    public function createMenu()
    {
        $Permission=new permission;
        $Result=$Permission->GetPermission();
        return $Result;
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
