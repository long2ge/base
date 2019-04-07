<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2019/4/7
 * Time: 3:22 PM
 */

namespace Modules\Core\Services;
use Modules\Core\Exceptions\InvalidArgumentException;

/**
 * 短信服务
 * Class ShortMessageService
 * @package Modules\Core\Services
 */
class ShortMessageService
{

    /**
     * 获取消息模版
     * User: long
     * Date: 2019/4/6 10:59 PM
     * Describe:
     * @param string $businessType 业务类型
     * @param string | int $code 验证码
     * @return string
     */
    public static function getMessageTemplate(string $businessType, $code)
    {
        switch ($businessType) {
            case 'modify_password' :
                return "尊敬的用户你现在的验证码是{$code}";
            case 'register' :
                return "尊敬的用户你现在的验证码是{$code}";
            default :
                throw new InvalidArgumentException('验证码业务类型错误!');
        }
    }

    /**
     * 发送短信
     * User: long
     * Date: 2019/4/7 3:24 PM
     * Describe:
     * @param string | int $phoneNumber 手机号码
     * @param string $content 短信内容
     */
    public static function sendSMS($phoneNumber, $content)
    {

    }
}