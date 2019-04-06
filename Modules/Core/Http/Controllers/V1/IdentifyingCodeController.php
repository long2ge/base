<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/3/19
 * Time: 1:18
 */

namespace Modules\Core\Http\Controllers\V1;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Core\Services\IdentifyingCodeService;

class IdentifyingCodeController extends CoreController
{
    /**
     * 请求发送验证码接口 (post)
     * User: long
     * Date: 2019/4/6 10:07 PM
     * Describe:
     * @param Request $request
     * @param IdentifyingCodeService $identifyingCodeService
     */
    public function sendCode(Request $request, IdentifyingCodeService $identifyingCodeService)
    {
        $parameters = [
            'phone_number' => 'required|string', // 手机号码
            'business_type' => 'required|string:modify_password,register', // 业务类型
            'source' => 'required|string:wechat_mini,wechat,app,web', // 来源
        ];

        // 校验参数
        $this->requestValidator($request, $parameters);

        // 获取参数
        $requestArr = $request->only(array_keys($parameters));

        try {

            $identifyingCodeService->identifyingCodeIsOverLimit($requestArr['phone_number']); // 校验手机验证码次数

            $identifyingCodeService->saveIdentifyingCode($requestArr); // 保存验证码

        } catch (\Exception $e) {
            $this->response()->errorBadRequest($e->getMessage());
        }

        // 返回报文
        $this->response()->noContent();
    }
}