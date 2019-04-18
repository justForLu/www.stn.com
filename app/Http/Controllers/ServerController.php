<?php

namespace App\Http\Controllers;
use App\Enums\AccountHotelModelEnum;
use App\Models\Admin\AccountsHotel;
use App\Repositories\AccountsRepository as Accounts;
use App\Services\Wechat\ServerService as Server;
use Illuminate\Http\Request;

/**
 * 微信服务通讯.
 */
class ServerController extends Controller
{
    /**
     * @var Server
     */
    private $server;

    /**
     * ServerController constructor.
     * @param Server $server
     */
    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    /**
     * 菜单授权链接分发服务 todo(结合菜单分发)
     * @param Request $request
     * @param Accounts $accounts
     * @return mixed|void
     */
    public function dispatchMenu(Request $request,Accounts $accounts){
        $params = $request->all();

        if(!isset($params['appid']) || empty($params['appid'])){
            abort(404);
        }

        $account = $accounts->getByAppId($params['appid']);
        if(!$account) abort(404);

        if(isset($params['code']) && !empty($params['code'])){
            // 存储当前公众号的信息
            session(['cur_account' => $account]);

            if(isset($params['state']) && !empty($params['state'])){
                $oauth = $this->server->getOauth($account,null);
                $user = $oauth->user();

                switch($params['state']){
                    case 'm1_1':
                        if($account->hotel_model == AccountHotelModelEnum::MULTIPLE){
                            // 多酒店模式
                            return redirect()->to("/hotel/index?openId=".$user->getId());
                        }else{
                            // 单酒店模式
                            $accountsHotel = AccountsHotel::where('accounts_id',$account->id)->first();
                            return redirect()->to("/hotel/detail?id={$accountsHotel->hotel_id}&openId=".$user->getId());
                        }
                        break;
                    case 'm1_2':
                        return redirect()->to("/hotel/user?openId=".$user->getId());
                        break;
                    case 'm1_3'://客房控制
                        return redirect()->to("/rcu/index?openId=".$user->getId());
                        break;
                    case 'm1_4'://开启房门
                        return redirect()->to("/rcu/door?openId=".$user->getId());

                        break;
                    default:
                }
            }else{
                abort(404);
            }
        }else{
            abort('404');
        }
    }

    /**
     * 返回服务端
     * @param Request $request
     * @param Accounts $accounts
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    public function serve(Request $request,Accounts $accounts){

        $account = $accounts->getByTag($request->t);

        if (!$account) {
            return;
        }

        return $this->server->make($account);
    }

    public function notify(){

    }

    public function callback(){

    }
}
