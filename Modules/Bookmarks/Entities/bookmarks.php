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
}
