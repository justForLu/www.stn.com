<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    const CREATED_AT='gmt_create';
    const UPDATED_AT='gmt_update';
    const DELETED_AT='gmt_delete';

    /**
     * 软删除
     */
    protected $softDelete = false;

    /**
     * 自动维护时间戳
     */
    public $timestamps = true;

}
