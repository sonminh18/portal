<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;

class userslist extends Model
{
    protected $table = "userslist";
    protected $fillable = ['username', 'phonenumber', 'email', 'image','updated_at'];
}
