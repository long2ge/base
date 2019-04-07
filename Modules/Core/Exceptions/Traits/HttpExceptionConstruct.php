<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/4/7
 * Time: 2:47 PM
 */

namespace Modules\Core\Exceptions\Traits;


trait HttpExceptionConstruct
{

    /**
     * 无效参数异常
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