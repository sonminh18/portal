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
        $OU=session('deptname');
        $Permission=new permission;
        $AllModule=$Permission->getAllModulePermissions($OU);
        $Result=array();
        $i=0;
        foreach ($AllModule as $value){
            if($value->iCheckPerFeat == 1){
                $Feature=$Permission->getFeatureWithCheckPerFeat($value->iModID);
                if(count($Feature)>0){
                    $Result[$i]['ModName']=$value->vModName;
                    $Result[$i]['ModLink']=$value->vModLink;
                    $Result[$i]['ModIcon']=$value->vModIcon;
                    $Result[$i]['Feature']=$Feature;
                }
            }
            else{
                $Feature=$Permission->getAllFeature($value->iModID);
                if(count($Feature)>0){
                    $Result[$i]['ModName']=$value->vModName;
                    $Result[$i]['ModLink']=$value->vModLink;
                    $Result[$i]['ModIcon']=$value->vModIcon;
                    $Result[$i]['Feature']=$Feature;
                }
            }
            $i=$i+1;
        }
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
