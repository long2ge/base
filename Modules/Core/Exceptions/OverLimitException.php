<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/4/6
 * Time: 10:17 PM
 */

namespace Modules\Core\Exceptions;
use Modules\Core\Exceptions\Traits\HttpExceptionConstruct;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * 超过限制异常
 * Class OverLimitException
 * @package Modules\Core\Exceptions
 */
class OverLimitException extends HttpException
{
    use HttpExceptionConstruct;
}