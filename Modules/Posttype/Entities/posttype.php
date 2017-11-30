<?php

namespace Modules\Posttype\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class posttype extends Model
{
    protected $table = "loaibaiviet";
    protected $fillable  = ['vTenLoaiBaiViet','iCapCha','vLienKet','vNguoiTao','iDelete','vNguoiCapNhat'];
    public function GetListAll($key,$pageindex,$pageSize){
        Paginator::currentPageResolver(function () use ($pageindex) {
            return $pageindex;
        });
        return $this->where('iDelete','=','0')->where('vTenLoaiBaiViet','like','%'.$key.'%')->paginate($pageSize);
    }
    public function GetPostTypeById($id){
        return $this->where('iMaLoaiBaiViet','=',$id)->first();
    }
}
