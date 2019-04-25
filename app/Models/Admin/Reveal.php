<?php

namespace App\Models\Admin;

use App\Enums\ModuleEnum;
use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reveal extends Base
{
    use SoftDeletes;
    // 模型对应表名
    protected $table = 'reveal';

    protected $fillable = ['name', 'synopsis', 'image', 'sort', 'status', 'is_recommend', 'author', 'read', 'content', 'gmt_create', 'gmt_update', 'gmt_delete'];

    public $timestamps = true;

}
