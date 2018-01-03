<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;


class modules extends Model
{
    protected $table = "modules";
    public function GetListAll($key,$pageindex,$pageSize){
        Paginator::currentPageResolver(function () use ($pageindex) {
            return $pageindex;
        });
        return $this->paginate($pageSize);
    }
    public function GetModuleByID($id){
        return $this
            ->where('iModID','=',$id)
            ->first();
    }
}
