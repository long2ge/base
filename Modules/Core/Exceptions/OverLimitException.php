<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/4/6
 * Time: 10:17 PM
 */

namespace Modules\Core\Exceptions;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * 超过限制异常
 * Class OverLimitException
 * @package Modules\Core\Exceptions
 */
class OverLimitException extends HttpException
{
    /**
     * 超过限制异常
     * OverLimitException constructor.
     * @param string|null $message
     * @param \Exception|null $previous
     * @param int $code
     * @param array $headers
     */
    public function __construct(string $message = null, \Exception $previous = null, int $code = 0, array $headers = [])
    {
        parent::__construct(400, $message, $previous, $headers, $code);
    }
}