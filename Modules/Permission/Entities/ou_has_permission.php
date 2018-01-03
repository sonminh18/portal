<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 11/13/2017
 * Time: 1:57 PM
 */
namespace Modules\Permission\Entities;
use Illuminate\Database\Eloquent\Model;

class ou_has_permission extends Model
{
    protected $table = "ou_has_permission";
    public function GetModule($ou){
        return $this->leftjoin('modules','ou_has_permission.iModID','=','modules.iModID')
            ->where('ou_has_permission.vOU','=',$ou)
            ->get();
    }

    public function GetOuWithModuleID($id){
        return $this
            ->where('iModID','=',$id)
            ->pluck('vOU')
            ->toArray();
    }
    public function GetOuAll($id){
        return $this
            ->where('iModID','=',$id)
            ->where('iCheckPerFeat','=','1')
            ->pluck('vOU')
            ->toArray();
    }
    public function GetOuFeat($id){
        return $this
            ->where('iModID','=',$id)
            ->where('iCheckPerFeat','=','0')
            ->pluck('vOU')
            ->toArray();
    }
}
