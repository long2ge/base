<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/4/11
 * Time: 0:43
 */

namespace Modules\User\Transformers;

use Modules\Core\Transformers\BaseTransformer;
use Modules\User\Models\User;

class UserTransformer extends BaseTransformer
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
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        $this->transformData($user);

        unset($this->data['password']);

        return $this->data;
    }

}