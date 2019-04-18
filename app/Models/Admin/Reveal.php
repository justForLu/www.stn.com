<?php

namespace App\Models\Admin;

use App\Enums\ModuleEnum;
use App\Models\Base;

class Reveal extends Base
{
    // 模型对应表名
    protected $table = 'reveal';

    protected $fillable = ['name','parent','path','grade','status','sort'];

    public $timestamps = false;

}
