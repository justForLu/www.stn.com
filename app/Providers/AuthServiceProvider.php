<?php

namespace App\Providers;

use App\Enums\BoolEnum;
use App\Repositories\Admin\ManagerRepository as Manager;
use App\Repositories\Admin\PermissionRepository as Permission;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @param Permission $permission
     * @param Manager $manager
     */
    public function boot(GateContract $gate,Permission $permission,Manager $manager)
    {
        parent::registerPolicies($gate);

        // 系统用户跳过权限检查
        $gate->before(function($user){
            if($user->is_system == BoolEnum::YES){
                return true;
            }
        });

        // 定义权限
        $permissions = $permission->all(array('id','code'));

        foreach($permissions as $permission){
            $codes = explode(',', $permission->code);

            foreach($codes as $code){
                $code = strtolower($code);
                $gate->define($code, function($user) use($permission,$manager){
                    return $manager->hasPermission($user,$permission);
                });
            }
        }
    }
}