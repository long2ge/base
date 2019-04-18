<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/4/18
 * Time: 20:02
 */

namespace Modules\Post\Transformers;

use Modules\Core\Transformers\BaseTransformer;
use Modules\Post\Models\Comment;

class CommentTransformer extends BaseTransformer
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
     * @param Comment $comment
     * @return array
     */
    public function transform(Comment $comment)
    {
        $this->transformData($comment);
        return $this->data;
    }
}