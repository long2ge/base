<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/4/6
 * Time: 10:10 PM
 */

namespace Modules\Core\Services;

use Modules\Core\Exceptions\OverLimitException;
use Modules\Core\Models\IdentifyingCodeLog;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * 验证码服务
 * Class IdentifyingCodeService
 * @package Modules\Core\Services
 */
class IdentifyingCodeService
{

    /**
     * @var int 每天限制的条数
     */
    private $everyDayLimit = 5;

    /**
     * 验证码是否超过限制
     * User: long
     * Date: 2019/4/6 10:24 PM
     * Describe:
     * @param string $phoneNumber 手机号码
     * @throws OverLimitException
     */
    public function identifyingCodeIsOverLimit($phoneNumber)
    {
        $count = app(IdentifyingCodeLog::class)->hasCodeCountByDate($phoneNumber);
        if ($this->everyDayLimit <= $count) {
            throw new OverLimitException('over limit ! limit times is : ' . $count);
        }
    }

    /**
     * 获取验证码
     * User: long
     * Date: 2019/4/7 3:38 PM
     * Describe:
     * @return int|string
     */
    public function getIdentifyingCode()
    {
        try {
            $code = random_int(100000,999999);
        } catch (\Exception $e) {
            $code = '888888';
        }

        return $code;
    }

    /**
     * 保存手机验证码
     * User: long
     * Date: 2019/4/7 12:21 AM
     * Describe:
     * @param array $requestArr 请求参数
     */
    public function saveIdentifyingCode(array $requestArr)
    {
        $code = $this->getIdentifyingCode();

        $content = ShortMessageService::getMessageTemplate($requestArr['business_type'], $code);

        $requestArr = array_merge($requestArr, [
            'code' => $code,
            'content' => $content,
        ]);

        if ( ! IdentifyingCodeLog::create($requestArr)) {
            throw new BadRequestHttpException('保存手机验证码失败!');
        }

        // 发送短信信息
        ShortMessageService::sendSMS($requestArr['phone_number'], $content);
    }

}