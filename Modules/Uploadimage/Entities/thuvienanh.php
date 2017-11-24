<?php

namespace Modules\Uploadimage\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class thuvienanh extends Model
{
    protected $table = "thuvienanh_baiviet";
    protected $fillable = ['vName', 'vUrl', 'vKichThuoc','vDungLuong','created_at','updated_at'];
    public function GetListAll($pageindex,$pageSize){
        Paginator::currentPageResolver(function () use ($pageindex) {
            return $pageindex;
        });
        return $this->orderBy('created_at', 'desc')->paginate($pageSize);
    }
}
