<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Validator;
use Dingo\Api\Exception\ValidationHttpException;

trait AdvanceValidators
{
    /**
     * 通用请求参数验证器
     * @param Request $request Request类
     * @param array   $rules   验证条件
     */
    protected function requestValidator(Request $request, array $rules)
    {
        $this->arrayValidator($request->all(), $rules);
    }

    /**
     * 通用请求参数验证器
     * @param array $arr 校验数组
     * @param array $rules 验证条件
     */
    protected function arrayValidator(array $arr, array $rules)
    {
        // 自定义返回错误语
        $messages = [
            'required' => 'missing_:attribute',
        ];

        $validator = Validator::make($arr, $rules, $messages);

        if ($validator->fails()) {
            $this->errorBadRequest($validator);
        }
    }

    /**
     * 参数验证错误返回
     * @param $validator
     */
    protected function errorBadRequest($validator)
    {
        // github like error messages
        // if you don't like this you can use code bellow
        //
        //throw new ValidationHttpException($validator->errors());

        $result = [];
        $messages = $validator->errors()->toArray();

        if ($messages) {
            foreach ($messages as $field => $errors) {
                foreach ($errors as $error) {
                    $result[] = [
                        'field' => $field,
                        'code' => $error,
                    ];
                }
            }
        }

        throw new ValidationHttpException($result);
    }
}