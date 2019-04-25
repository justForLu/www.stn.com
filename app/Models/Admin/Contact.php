<?php

namespace App\Models\Admin;

use App\Enums\ModuleEnum;
use App\Models\Base;

class Contact extends Base
{
    // 模型对应表名
    protected $table = 'contact';

    protected $fillable = ['qq', 'location', 'content', 'gmt_create', 'gmt_update', 'gmt_delete'];

    public $timestamps = true;

}
