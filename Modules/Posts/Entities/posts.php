<?php

namespace Modules\Posts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class posts extends Model
{
    protected $table = "baiviet";
    protected $guarded = ['iMaBaiViet','iBinhLuan'];
    public function GetListAll($key,$pageindex,$pageSize){
        Paginator::currentPageResolver(function () use ($pageindex) {
            return $pageindex;
        });
        return $this->where('iDelete','=',0)->where('vTieuDe','like','%'.$key.'%')->paginate($pageSize);
    }
    public function GetPostById($id){
        return $this->where('iMaBaiViet','=',$id)->first();
    }
}
