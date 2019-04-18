<?php

namespace App\Models\Admin;

use App\Enums\ModuleEnum;
use App\Models\Base;

class CheckCategory extends Base
{
    // 模型对应表名
    protected $table = 'check_category';

    protected $fillable = ['name','parent','path','grade','status','sort'];

    public $timestamps = false;

}
