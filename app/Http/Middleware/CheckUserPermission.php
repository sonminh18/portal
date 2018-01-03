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
use App\helper;

class CheckUserPermission
{

    public function handle($request, Closure $next)
    {
        $helper=new helper();
        $action = explode("/",$request->route()->uri);
        if(count($action)>1){
            $PerChecker=new PermissionChecker();
            $ArrPermission=$PerChecker->GetPermission();
            $ModuleLink=$action[0];
            $FeatLink=$action[1];
            $IsExist=$helper->SearchArray("$ModuleLink",'ModLink',$ArrPermission);
            if( $IsExist == null){
                return redirect('/');
            }
            else{
                $result=0;
                foreach ($ArrPermission as $Feat){
                    if($helper->SearchArray("$FeatLink",'vFeatLink',$Feat['Feature']) == null){
                        $result++;
                    }
                }
                if($result!=0){
                    return $next($request);
                }
                else{
                    return redirect('/');
                }
            }
        }
        else{
            return $next($request);
        }
    }

}