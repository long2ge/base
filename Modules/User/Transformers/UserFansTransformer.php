<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/4/9
 * Time: 23:06
 */

namespace Modules\User\Transformers;


use Modules\Core\Transformers\BaseTransformer;
use Modules\User\Models\UserFans;

class UserFansTransformer extends BaseTransformer
{

    /**
     * 过滤参数
     *
     * @var array
     */
    protected $params;

    /**
     * 构造方法
     * UserTransformer constructor.
     * @param array $params
     */
    public function __construct($params = [])
    {
        $this->params = $params;
    }

    /**
     * 转化方法
     * @param UserFans $userFans
     * @return array
     */
    public function transform(UserFans $userFans)
    {

        $this->transformData($userFans);

        return $this->data;
    }
}
