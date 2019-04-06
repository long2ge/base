<?php

namespace App\Http\Controllers;


use App\Traits\AdvanceValidators;
use Dingo\Api\Routing\Helpers;
use Laravel\Lumen\Routing\Controller;

class BaseController extends Controller
{
    // 接口帮助调用
    use Helpers;
    use AdvanceValidators;
}