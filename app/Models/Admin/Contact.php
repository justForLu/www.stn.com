<?php

namespace App\Models\Admin;

use App\Enums\ModuleEnum;
use App\Models\Base;

class Contact extends Base
{
    // 模型对应表名
    protected $table = 'contact';

    protected $fillable = ['name','parent','path','grade','status','sort'];

    public $timestamps = false;

}
