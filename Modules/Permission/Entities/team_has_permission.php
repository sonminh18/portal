<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 1/3/2018
 * Time: 9:07 AM
 */
namespace Modules\Permission\Entities;
use Illuminate\Database\Eloquent\Model;

class team_has_permission extends Model
{
    protected $table = "team_has_permission";
    public function GetFeatureAllowed($Team){
        return $this
            ->select('iFeatID')
            ->where('vTeamName','=',$Team)
            ->pluck('iFeatID');
    }
}