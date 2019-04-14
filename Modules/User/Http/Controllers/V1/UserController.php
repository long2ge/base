<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/4/11
 * Time: 0:38
 */

namespace Modules\User\Http\Controllers\V1;

use Modules\Core\Services\regionService;
use Modules\User\Http\Controllers\BaseUserController;
use Modules\User\Models\User;
use Modules\User\Models\UserFans;
use Modules\User\Services\UserService;
use Modules\User\Transformers\UserTransformer;

class UserController extends BaseUserController
{

    /**
     * @var UserService
     */
    private $userService;

    /**
     * 构造函数
     * UserService constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * 获取用户基本信息
     * @return \Dingo\Api\Http\Response
     */
    public function show()
    {
        $user = User
            ::where('id', 10000001)
            ->select([
                'account',
                'user_name',
                'phone_number',
                'email',
                'profile',
                'avatar',
                'address',
                'province_id',
                'city_id',
                'zone_id',
                'occupation_id',
                'sex',
                'status',
            ])
            ->first();

        if ( ! $user) return $this->response()->noContent();

        app(regionService::class)->getRegionByUser($user); // 把地区ID转化为地区名。

        return $this->response
            ->item($user, new UserTransformer())
            ->setStatusCode(200);
    }

    /**
     * 用户的粉丝数量
     * @return array
     */
    public function fansCount()
    {
        return [
            'fans' => UserFans::where('user_id', 10000001)->count(),
        ];
    }

    /**
     * 用户关注的人数
     * @return array
     */
    public function concernsCount()
    {
        return [
            'fans' => UserFans::where('fan_id', 10000001)->count(),
        ];
    }

}