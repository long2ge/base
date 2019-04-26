<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/4/26
 * Time: 19:16
 */

namespace Modules\Order\Http\Controllers\V1;


use Modules\Order\Http\Controllers\BaseOrderController;

class TestController extends BaseOrderController
{

    public function test()
    {
        dd('test');
    }

}