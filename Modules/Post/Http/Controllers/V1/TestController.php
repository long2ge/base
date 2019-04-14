<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/3/19
 * Time: 1:18
 */

namespace Modules\Post\Http\Controllers\V1;


use Modules\Post\Http\Controllers\BasePostController;

class TestController extends BasePostController
{
    public function test()
    {
        return 111;
    }
}