<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 1/3/2018
 * Time: 9:32 AM
 */

namespace Modules\Permission\Entities;
use Illuminate\Database\Eloquent\Model;

class features extends Model
{
    protected $table = "features";
    /* Lấy ra các features trong bảng features mỗi khi truyền vào 1 ModuleID
    */
    public function GetFeatures($ModuleID){
        return $this
            ->where('iModID','=',$ModuleID)
            ->get();
    }
}