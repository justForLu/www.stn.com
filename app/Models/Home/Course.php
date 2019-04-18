<?php

namespace App\Models\Home;

use App\Enums\ModuleEnum;
use App\Models\Base;

class Course extends Base
{
    // 模型对应表名
    protected $table = 'course';

    protected $fillable = ['title','image','video','introduce','content','sort','gmt_create','status','is_top'];

    public $timestamps = false;

}
