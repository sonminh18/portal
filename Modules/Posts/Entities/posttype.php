<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 11/23/2017
 * Time: 1:11 PM
 */

namespace Modules\Posts\Entities;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Pagination\Paginator;

class posttype extends Model
{
    protected $table = "loaibaiviet";
    public function GetAllPostType(){
        return $this->all();
    }
}
