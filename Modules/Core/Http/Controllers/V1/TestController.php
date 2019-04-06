<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/3/19
 * Time: 1:18
 */

namespace Modules\Core\Http\Controllers\V1;


use Modules\User\Http\Controllers\UserController;
use Modules\User\Models\User;

class TestController extends UserController
{
    public function test()
    {

        return 1111;
    }
}