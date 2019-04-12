<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/3/19
 * Time: 1:18
 */

namespace Modules\Core\Http\Controllers\V1;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\BaseCoreController;
use Modules\Core\Services\IdentifyingCodeService;

class IdentifyingCodeController extends BaseCoreController
{

    /**
     * @var IdentifyingCodeService 验证码服务
     */
    private $identifyingCodeService;

    /**
     * 构造函数
     * IdentifyingCodeController constructor.
     * @param IdentifyingCodeService $identifyingCodeService
     */
    public function __construct(IdentifyingCodeService $identifyingCodeService)
    {
        $this->identifyingCodeService = $identifyingCodeService;
    }

    /**
     * 请求发送验证码接口 (post)
     * User: long
     * Date: 2019/4/6 10:07 PM
     * Describe:
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(Request $request)
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

        $this->identifyingCodeService->identifyingCodeIsOverLimit($requestArr['phone_number']); // 校验手机验证码次数

        $this->identifyingCodeService->saveIdentifyingCode($requestArr); // 保存验证码

        // 返回报文
        return $this->response()->noContent();
    }
}