<?php

namespace App\Models\Home;

use App\Enums\ModuleEnum;
use App\Models\Base;

class Feedback extends Base
{
    // 模型对应表名
    protected $table = 'feedback';

    protected $fillable = ['name', 'mobile', 'email', 'content', 'status', 'remarks', 'gmt_create', 'gmt_update', 'gmt_delete'];

    public $timestamps = true;

}
