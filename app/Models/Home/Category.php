<?php

namespace App\Models\Home;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Base
{
    use SoftDeletes;
    // 模型对应表名
    protected $table = 'category';

    protected $fillable = ['name', 'type', 'sort', 'status', 'gmt_create', 'gmt_update', 'gmt_delete'];

    public $timestamps = true;

}
