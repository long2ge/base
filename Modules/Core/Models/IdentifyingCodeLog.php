<?php

namespace Modules\Core\Models;

use Carbon\Carbon;

class IdentifyingCodeLog extends BaseModel
{
    /**
     * The connection name for the model
     * 库链接的配置名
     *
     * @var string
     */
    protected $connection = 'cloud_core';

    /**
     * Table Name
     * 表名
     *
     * @var string
     */
    protected $table = 'identifying_code_logs';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'phone_number',
        'code',
        'content',
        'business_type',
        'source',
    ];

    /**
     * 查询某天的短信数量
     * User: long
     * Date: 2019/4/6 8:59 PM
     * Describe:
     * @param string $phoneNumber 手机号码
     * @param string $businessType 业务类型 modify_password 修改密码, register 注册
     * @param string | null $date 日期 年月日
     * @return mixed
     */
    public function hasCodeCountByDate($phoneNumber, $businessType, $date = null)
    {
        if ($date === null) $date = Carbon::now()->toDateString();

        return $this
            ->where('phone_number', $phoneNumber)
            ->where('business_type', $businessType)
            ->whereDate('created_at', $date)->count();
    }
}
