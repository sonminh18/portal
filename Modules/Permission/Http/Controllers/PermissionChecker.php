<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 11/13/2017
 * Time: 1:28 PM
 */

namespace Modules\Permission\Http\Controllers;
use Modules\Permission\Entities\Permission;


class PermissionChecker
{
    /**
     * Lấy tất cả các module được phép truy cập
     * dựa theo session OU của User
     */
    public function getAllModulePermissions($OU){
        $data=Permission::getModulebyOU($OU);
        return $data;
    }
    /**
     * Lấy các feature được phép truy cập
     * @Trường hợp:
     * Đối với các module cần kiểm tra các feature user dc truy cập
     */
    public function getFeatureWithCheckPerFeat($iModID){
        $data=Permission::getFeatureWithCheck($iModID);
        return $data;
    }
    /**
     * Lấy tất cả các feature được phép truy cập
     * @Trường hợp:
     * Lấy tất cả không cần kiểm tra
     */
    public function getAllFeature($iModID){
        $data=Permission::getAllFeat($iModID);
        return $data;
    }
}