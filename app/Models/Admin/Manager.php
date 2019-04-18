<?php

namespace App\Models\Admin;

use App\Enums\BasicEnum;
use App\Enums\BoolEnum;
use App\Enums\ModuleEnum;
use App\Models\Base;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manager extends Base implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    // 模型对应表名
    protected $table = 'manager';

    protected $fillable = ['username','password','remember_token','gmt_last_login','last_ip','status','parent','path','is_system','gmt_create','gmt_update','gmt_delete'];

    protected $attributes = array(
        'status' => BasicEnum::ACTIVE,
        'is_system' => BoolEnum::NO
    );

    /**
     * 获取管理员的角色
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function roles(){
        return $this->belongsToMany(Role::class,'role_user','user_id','role_id')->wherePivot('module',ModuleEnum::ADMIN);
    }
}
