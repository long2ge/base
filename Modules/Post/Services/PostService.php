<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/4/18
 * Time: 19:47
 */

namespace Modules\Post\Services;

use Modules\Post\Models\Post;
use Modules\Post\Models\PostFavor;
/* method 3
use Modules\User\Services\UserService;
use Modules\Post\Models\SpeechRecord; */

class PostService
{
    /**
     * 发表帖子
     * @param int | string $userId 帖子id
     * @param string $title 标题
     * @param string $content 内容
     */
    public function postIssue($userId, $title, $content)
    {
        Post::create([
            'user_id' => $userId,
            'title' => $title,
            'content' => $content,
        ]);
    }

    /**
     * 删除帖子
     * @param int | string $postId 帖子id
     */
    public function postDelete($postId)
    {
        Post::findOrFail($postId)->delete();
    }

    /**
     * 恢复帖子
     * @param int | string $postId 帖子id
     */
    public function postRecover($postId)
    {
        Post::onlyTrashed()->where('id', $postId)->restore();
    }

    /**
     * 显示单条帖子
     * @param int | string $postId 帖子id
     * @return null
     */
    public function postShow($postId)
    {
        /* method 1 */
        $post = Post::where('id', $postId)->with([
            'user' => function ($queryUserName) {
            $queryUserName->select(['user_name']);
        }])->firstOrFail();

        $post->user_name = $post->user->user_name;
        $post->speechCount = $post->speechRecord ? $post->speechRecord->count() : 0;

        /* method 2
        $post = Post::findOrFail($postId);
        $post->user_name = $post->user()->select(['user_name'])->first()->user_name;
        $post->speechCount = $post->speechRecord()->count(); */

        /* method 3
        $post = Post::findOrFail($postId);
        $post->speechCount = $post->speechRecord()->count(); */

        return $post;
    }

    /**
     * 帖子置顶
     * @param int | string $postId 帖子id
     * @param int | string $userId 用户id
     * @param bool $isStick 是否置顶
     */
    public function switchStick($postId, $userId, $isStick)
    {
        if ($isStick) {
            Post::where('user_id', $userId)
                ->where('stick', 1)
                ->update(['stick' => 0]);

            Post::where('post_id', $postId)
                ->where('user_id', $userId)
                ->update(['stick' => 1]);

            return;
        }

        Post::where('user_id', $userId)
            ->where('post_id', $postId)
            ->update(['stick' => 0]);
    }

    /**
     * 帖子点赞
     * @param int | string $postId 帖子id
     * @param int | string $userId 帖子id
     * @param bool $isFavor 是否点赞
     */
    public function switchFavor($postId, $userId, $isFavor)
    {
        $isFavor ? PostFavor::create([
                        'post_id' => $postId,
                        'user_id' => $userId,
                    ])
                 : PostFavor::where('post_id', $postId)
                     ->where('user_id', $userId)
                     ->delete();
    }

    /**
     * 显示帖子标题
     * @param int | string $postId 帖子id
     * @return mixed
     */
    public function showPostTitle($postId)
    {
        $title = Post::findOrFail($postId)->title;
        return $title;
    }

    /**
     * 显示帖子回复数
     * @param int | string $postId 帖子id
     * @return mixed
     */
    public function speechCount($postId)
    {
        $post = $this->postShow($postId);
        return $post->speechCount;
    }
}