<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 11/27/2017
 * Time: 9:41 AM
 */

namespace Modules\Posts\Entities;
use Illuminate\Database\Eloquent\Model;

class tags extends Model
{
    protected $table = "tags";
    public function GetAllTags(){
        return $this->all();
    }
}