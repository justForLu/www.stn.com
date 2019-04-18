<?php
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Repositories\Admin\MenuRepository as Menu;
use App\Services\TreeService;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Admin\ManagerRepository as Manager;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;

class LoginController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * 登录成功跳转
     * @var string
     */
    protected $redirectTo = '/admin';
    /**
     * 退出跳转
     * @var string
     */
    protected $redirectAfterLogout = '/admin/login';

    /**
     * 指定用户名字段
     * @var string
     */
    protected $username = 'username';

    /**
     * 指定guard
     * @var string
     */
    protected $guard = 'admin';

    /**
     * @var
     */
    protected $manager;

    /**
     * @var
     */
    protected $menu;

    /**
     * LoginController constructor.
     * @param Manager $manager
     * @param Menu $menu
     */
    public function __construct(Manager $manager,Menu $menu)
    {
//        $this->middleware('guest', ['except' => 'getLogout']);
        $this->manager = $manager;
        $this->menu = $menu;
    }

    /**
     * 登录视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index()
    {
        return view('admin.login.index');
    }

    /**
     * 登录校验处理(重写框架默认自带的登录校验)
     * @param LoginRequest $loginRequest
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(LoginRequest $loginRequest)
    {
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($loginRequest)) {
            $this->fireLockoutEvent($loginRequest);

            return $this->sendLockoutResponse($loginRequest);
        }

        $credentials = $this->getCredentials($loginRequest);

        if (Auth::guard($this->getGuard())->attempt($credentials, $loginRequest->has('remember'))) {

            $this->updateLoginInfo($loginRequest);

            // 获取用户菜单
            $uid = Auth::user()->id;
            $userMenus = $this->menu->getUserMenuTree();

            // 缓存用户菜单
            Cache::store('file')->forever('menu_user_' . $uid,json_encode($userMenus));

            if ($throttles) {
                $this->clearLoginAttempts($loginRequest);
            }

            return response()->json(['status' => 'success','code' => '200','msg' => Lang::get('auth.success'),'referrer' => $this->redirectPath()]);
        }

        return response()->json(['status' => 'fail','code' => '300','msg' => $this->getFailedLoginMessage()]);
    }

    /**
     * 更新用户的登录信息
     * @param $loginRequest
     */
    public function updateLoginInfo($loginRequest)
    {
        $data['last_ip'] = $loginRequest->ip();
        $data['gmt_last_login'] = get_date();
        $uid = Auth::User()->id;
        $this->manager->update($data,$uid);
    }

    /**
     * 用户登出
     * @return mixed
     */
    public function logout()
    {
        Auth::guard($this->getGuard())->logout();
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
}
