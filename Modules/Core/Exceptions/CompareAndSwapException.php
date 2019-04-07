<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/3/23
 * Time: 11:22 PM
 */

namespace Modules\Core\Exceptions;
use Modules\Core\Exceptions\Traits\HttpExceptionConstruct;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * CAS异常类
 * Class CompareAndSwapException
 * @package Modules\Core\Exceptions
 */
class CompareAndSwapException extends HttpException
{
    use HttpExceptionConstruct;
}