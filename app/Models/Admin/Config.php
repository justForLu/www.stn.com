<?php

namespace App\Models\Admin;

use App\Enums\ModuleEnum;
use App\Models\Base;

class Config extends Base
{
    // 模型对应表名
    protected $table = 'config';

    protected $fillable = ['company', 'phone', 'mobile', 'wechat', 'copyright', 'code', 'reveal', 'address', 'gmt_create', 'gmt_update'];

    public $timestamps = true;

}
