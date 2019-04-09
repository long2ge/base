<?php


namespace Modules\Core\Transformers;

use League\Fractal\TransformerAbstract;

class BaseTransformer extends TransformerAbstract
{
    /**
     * 返回数据
     *
     * @var array $data
     */
    protected $data;

    /**
     * 自定义字段黑名单
     *
     * @var array
     */
    protected $hidden;

    /**
     * 自定义字段白名单
     *
     * @var array
     */
    protected $visible;

    /**
     * 过滤参数
     *
     * @var array
     */
    protected $params;

    /**
     * Restful API 接收数据过滤参数并且过滤返回数据
     * @param array $data
     * @param array $params
     */
    public function restfulDataFilter(array &$data, array $params)
    {
        if (isset($params['fields']) && !empty($params['fields'])) { // 获取需要的字段
            $data = array_where($data, function ($value, $key) use ($params) {
                if (empty($value)) return false;
                return in_array($key, $params['fields']);
            });
        } elseif (isset($params['exclude_fields']) && !empty($params['exclude_fields'])) { // 过滤字段
            $data = array_where($data, function ($value, $key) use ($params) {
                if (empty($value)) return false;
                return !in_array($key, $params['exclude_fields']);
            });
        }
    }

    /**
     * 过滤可返回的字段, 组装返回的data
     * @param $model
     * @param $options
     * @return void
     */
    public function transformData($model, $options = [])
    {
        // Restful API 接收数据过滤参数并且过滤返回数据
        if (!empty($options)) {
            if (isset($options['fields']) && !empty($options['fields'])) {
                // 使用传过来的白名单
                if ($this->hidden) {
                    // transformer自身的黑名单有最高权限
                    $this->visible = array_diff((array) $options['fields'], $this->hidden);
                } else {
                    $this->visible = (array) $options['fields'];
                }
            } elseif (isset($options['exclude_fields']) && !empty($options['exclude_fields'])) {
                // 使用传过来的黑名单
                if ($this->hidden) {
                    // transformer自身的黑名单有最高权限
                    $this->hidden = array_merge((array) $options['exclude_fields'], $this->hidden);
                } else {
                    $this->hidden = (array) $options['exclude_fields'];
                }
            }
        }

        $this->data = array_where($model->getAttributes(), function ($value, $key) {
            if ($this->visible) {
                return in_array($key, $this->visible);
            } elseif ($this->hidden) {
                return !in_array($key, $this->hidden);
            }
            return true;
        });
    }
}