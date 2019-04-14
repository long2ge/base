<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/3/19
 * Time: 1:18
 */

namespace Modules\User\Http\Controllers\V1;

use Modules\User\Http\Controllers\BaseUserController;
use Modules\User\Models\User;

class TestController extends BaseUserController
{
    public function test()
    {
        $user = app(User::class)->find(1);

        return $user;
    }
}