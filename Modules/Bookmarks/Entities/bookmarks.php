<?php

namespace Modules\Bookmarks\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class bookmarks extends Model
{
    protected $table = "bookmarks";
    protected $fillable  = ['vBookName','vBookLink','vBookColor','vBookIcon','vOwner','iShowAll','vUpdater'];
    public function GetListAll($key,$pageindex,$pageSize){
        Paginator::currentPageResolver(function () use ($pageindex) {
            return $pageindex;
        });
        return $this->where('vBookName','like','%'.$key.'%')->where('vBookLink','like','%'.$key.'%')->paginate($pageSize);
    }
    public function GetPostTypeById($id){
        return $this->where('iBookID','=',$id)->first();
    }
    public function bookmarkpermission(){
        return $this->hasMany('Modules\Bookmarks\Entities\bookmarkpermission','iBookID');
    }
    public function deleteBookMark($id)
    {
        return $this->where('iBookID','=',$id)->delete();
    }
    public function GetBookMarkById($id){
        return $this->where('iShowAll','=',0)->where('iBookID','=',$id)->get();
    }
    public function GetBookMarkByTeamName($teamname){
        return $this->where('vOwner','=',$teamname)->get();
    }
}
