<?php

namespace App\Models\Admin;

use App\Enums\ModuleEnum;
use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Base
{
    use SoftDeletes;
    // 模型对应表名
    protected $table = 'feedback';

    protected $fillable = ['name', 'mobile', 'email', 'content', 'status', 'remarks', 'gmt_create', 'gmt_update', 'gmt_delete'];

    public $timestamps = true;

}
