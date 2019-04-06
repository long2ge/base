<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/4/6
 * Time: 10:10 PM
 */

namespace Modules\Core\Services;

use Modules\Core\Exceptions\InvalidArgumentException;
use Modules\Core\Exceptions\OverLimitException;
use Modules\Core\Models\IdentifyingCodeLog;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

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
        if ($this->everyDayLimit > $count) {
            throw new OverLimitException('over limit ! limit times is : ' . $count);
        }
    }

    /**
     * 获取内容
     * User: long
     * Date: 2019/4/6 10:59 PM
     * Describe:
     * @param string $businessType 业务类型
     * @param string | int $code 验证码
     * @return string
     */
    public function getContent(string $businessType, $code)
    {
        switch ($businessType) {
            case 'modify_password' :
                return "尊敬的用户你现在的验证码是{$code}";
            case 'register' :
                return "尊敬的用户你现在的验证码是{$code}";
            default :
                throw new InvalidArgumentException('验证码业务类型错误!');
                break;
        }
    }

    /**
     * 请求参数
     * User: long
     * Date: 2019/4/6 11:01 PM
     * Describe:
     * @param array $requestArr 请求参数
     */
    public function saveIdentifyingCode(array $requestArr)
    {
        $code = 123456;

        $requestArr = array_merge($requestArr, [
            'code' => $code,
            'content' => $this->getContent($requestArr['business_type'], $code),
        ]);

        if ( ! IdentifyingCodeLog::create($requestArr)) {
            throw new BadRequestHttpException('保存手机验证码失败!');
        }
    }

}