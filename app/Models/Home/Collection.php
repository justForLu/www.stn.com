<?php

namespace App\Models\Home;

use App\Enums\ModuleEnum;
use App\Models\Base;

class Collection extends Base
{
    // 模型对应表名
    protected $table = 'collection';

    protected $fillable = ['news_id','user_id','gmt_create'];

    public $timestamps = false;

}
