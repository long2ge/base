<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/4/18
 * Time: 19:39
 */

namespace Modules\Post\Transformers;

use Modules\Core\Transformers\BaseTransformer;
use Modules\Post\Models\Post;

class PostTransformer extends BaseTransformer
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
     * @param Post $post
     * @return array
     */
    public function transform(Post $post)
    {
        $this->transformData($post);

        if ($this->params['type'] == 'index') {
            $this->data['abstract'] = mb_substr($this->data['content'], 0, 50);
            unset($this->data['content']);
        }

        return $this->data;
    }
}