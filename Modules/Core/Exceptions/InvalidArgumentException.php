<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/4/6
 * Time: 10:56 PM
 */

namespace Modules\Core\Exceptions;

use Modules\Core\Exceptions\Traits\HttpExceptionConstruct;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * 无效参数异常
 * Class InvalidArgumentException
 * @package Modules\Core\Exceptions
 */
class InvalidArgumentException extends HttpException
{
    use HttpExceptionConstruct;
}