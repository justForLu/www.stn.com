<?php

namespace App\Models\Admin;

use App\Enums\ModuleEnum;
use App\Models\Base;

class Banner extends Base
{
    // 模型对应表名
    protected $table = 'banner';

    protected $fillable = ['title', 'position', 'image', 'sort', 'status', 'gmt_create', 'gmt_update', 'gmt_delete'];

    public $timestamps = true;

}
