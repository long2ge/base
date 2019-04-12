<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/4/12
 * Time: 23:23
 */

namespace Modules\Core\Transformers;

use Modules\Core\Models\Region;

class RegionTransformer extends BaseTransformer
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
     * @param Region $region
     * @return array
     */
    public function transform(Region $region)
    {
        $this->transformData($region);

        return $this->data;
    }
}