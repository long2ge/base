<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/4/7
 * Time: 4:15 PM
 */

namespace Modules\Core\Http\Controllers\V1;


use Modules\Core\Http\Controllers\CoreController;
use Modules\Core\Services\AuthService;

class AuthController extends CoreController
{
    /**
     * @var AuthService 认证服务
     */
    private $authService;

    /**
     * 构造函数
     * AuthService constructor.
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function loginByPassword($name, $password)
    {

    }
}