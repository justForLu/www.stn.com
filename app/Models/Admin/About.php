<?php

namespace App\Models\Admin;

use App\Enums\ModuleEnum;
use App\Models\Base;

class About extends Base
{
    // 模型对应表名
    protected $table = 'about';

    protected $fillable = ['image', 'content', 'gmt_create', 'gmt_update'];

    public $timestamps = true;

}
