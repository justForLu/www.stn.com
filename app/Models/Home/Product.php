<?php

namespace App\Models\Home;

use App\Enums\ModuleEnum;
use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Base
{
    use SoftDeletes;
    // 模型对应表名
    protected $table = 'product';

    protected $fillable = ['name', 'synopsis', 'image', 'picture', 'content', 'type', 'status', 'sort', 'is_recommend', 'read', 'gmt_create', 'gmt_update', 'gmt_delete'];

    public $timestamps = true;

}
