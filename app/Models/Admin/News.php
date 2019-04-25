<?php

namespace App\Models\Admin;

use App\Enums\ModuleEnum;
use App\Models\Base;

class News extends Base
{
    // 模型对应表名
    protected $table = 'news';

    protected $fillable = ['title', 'image', 'type', 'introduce', 'content', 'author', 'manager_id', 'is_top', 'sort',
        'is_recommend', 'status', 'read', 'gmt_create', 'gmt_create', 'gmt_update'];

    public $timestamps = true;

}
