<?php

namespace App\Models\Home;

use App\Enums\ModuleEnum;
use App\Models\Base;

class News extends Base
{
    // 模型对应表名
    protected $table = 'news';

    protected $fillable = ['title','content','image','introduce','release_type','gmt_release','gmt_create','gmt_update','status','is_top'];

    public $timestamps = false;

}
