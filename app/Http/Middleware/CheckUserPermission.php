<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 11/22/2017
 * Time: 2:33 PM
 */
namespace App\Http\Middleware;
use Modules\Permission\Http\Controllers\PermissionChecker;
use Closure;
use session;

class CheckUserPermission
{

    public function handle($request, Closure $next)
    {

        $action = explode("/",$request->route()->uri);
        if(count($action)>1){
            $PerChecker=new PermissionChecker();
            $OU=session('deptname');
            $ArrModule=$PerChecker->getAllModulePermissions($OU);
            $ModuleName=$action[0];
            $FeatName=$action[1];
            $result=array();
            foreach ($ArrModule as $k=>$v){
                if(stripos($v->vModLink, $OU) !== false){
                    array_push($result,$v);
                }
            }
            if(count($result) == 0){
//                return redirect('/');
                return $next($request);
            }
            else{
                return $next($request);
            }
        }
        else{
            return $next($request);
        }
    }

}