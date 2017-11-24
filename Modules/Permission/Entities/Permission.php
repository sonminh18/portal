<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 11/13/2017
 * Time: 1:57 PM
 */
namespace Modules\Permission\Entities;

use Illuminate\Support\Facades\DB;


class Permission
{
    public static function getModulebyOU($OU){
        return DB::table('modules')->leftjoin('per_mod_by_ou','per_mod_by_ou.iModID','=','modules.iModID')
            ->where('per_mod_by_ou.vOU',$OU)
            ->get();
    }
    public static function getFeatureWithCheck($iModID){
        return DB::table('features')->join('per_feat_by_mem_of','per_feat_by_mem_of.iFeatID','=','features.iFeatID')
            ->where('iModID',$iModID)
            ->get();
    }
    public static function getAllFeat($iModID){
        return DB::table('features')->where('iModID',$iModID)->get();
    }
}
