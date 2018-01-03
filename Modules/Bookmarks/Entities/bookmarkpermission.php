<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 12/4/2017
 * Time: 1:21 PM
 */

namespace Modules\Bookmarks\Entities;
use Illuminate\Database\Eloquent\Model;

class bookmarkpermission extends Model
{
    protected $table = "bookmarkpermission";
    protected $fillable  = ['iBookPer','iBookID','vTeamName'];
    public function bookmark()
    {
        return $this->belongsTo('Modules\Bookmarks\Entities\bookmarks','iBookID');
    }
    public function deleteBookMarkPermission($id)
    {
        return $this->where('iBookID','=',$id)->delete();
    }
    public function GetBookMarkPermissionByRole($id,$role){
        return $this
            ->where('iBookID','=',$id)
            ->where('vTeamName','=',$role)
            ->get()
            ->count();
    }
}