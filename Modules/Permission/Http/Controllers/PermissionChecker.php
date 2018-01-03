<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 11/13/2017
 * Time: 1:28 PM
 */

namespace Modules\Permission\Http\Controllers;
use Modules\Permission\Entities\ou_has_permission;
use Modules\Permission\Entities\features;
use Modules\Permission\Entities\team_has_permission;
use App\helper;

class PermissionChecker
{
    private $ou_has_permission;
    private $feature;
    private $team_has_permission;
    private $helper;
    public function __construct()
    {
        $this->ou_has_permission= new ou_has_permission();
        $this->feature= new features();
        $this->team_has_permission = new team_has_permission();
        $this->helper= new helper();
    }

    /**
     * Lấy tất cả các module được phép truy cập
     * dựa theo session OU của User
     */
    public function getAllModulePermissions($OU){
        $data=$this->ou_has_permission->GetModule($OU);
        return $data;
    }
    /**
     * Lấy các feature được phép truy cập
     * @Trường hợp:
     * Đối với các module cần kiểm tra các feature user dc truy cập
     */
    public function getFeatureWithCheckPerFeat($iModID,$TeamName){
        //array chứa tất cả các feature theo moduleID
        $Arr_All_Feature= $this->getAllFeature($iModID);
        //array chứa moduleID được allow
        $Arr_Feature_Allowed= $this->team_has_permission->GetFeatureAllowed($TeamName);
        //array chứa dữ liệu sau khi xử lý
        $Arr_Result=array();
        foreach ($Arr_All_Feature as $item){
            if($this->helper->customSearch("$item->iFeatID",$Arr_Feature_Allowed) != null){
                array_push($Arr_Result,$item);
            }
        }
        return $Arr_Result;
    }
    /**
     * Lấy tất cả các feature được phép truy cập
     * @Trường hợp:
     * Lấy tất cả không cần kiểm tra
     */
    public function getAllFeature($iModID){
        $data=$this->feature->GetFeatures($iModID);
        return $data;
    }
    public function GetPermission()
    {
        $OU=session('deptname');
        $TeamName=session('teamname');
        $AllModule=$this->getAllModulePermissions($OU);
        $Result=array();
        $i=0;
        foreach ($AllModule as $value){
            if($value->iCheckPerFeat == 1){
                $Feature=$this->getFeatureWithCheckPerFeat($value->iModID,$TeamName);
                if(count($Feature)>0){
                    $Result[$i]['ModName']=$value->vModName;
                    $Result[$i]['ModLink']=$value->vModLink;
                    $Result[$i]['ModIcon']=$value->vModIcon;
                    $Result[$i]['Feature']=$Feature;
                }
            }
            else{
                $Feature=$this->getAllFeature($value->iModID);
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
}