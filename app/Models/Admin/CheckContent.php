<?php

namespace App\Models\Admin;

use App\Enums\ModuleEnum;
use App\Models\Base;

class CheckContent extends Base
{
    // 模型对应表名
    protected $table = 'check_content';

    protected $fillable = ['title','symptom','details','solve','prompt','type_first_id','type_second_id','fault','status','gmt_create'];

    public $timestamps = false;

}
