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
// use Modules\User\Services\UserService; // method 3

class PostService
{
    /**
     * @param string | int $postId 帖子id
     * @return null
     */
    public function postShow($postId)
    {
        $post = Post::where('id', $postId)->with([
            'user' => function ($query) {
                $query->select(['user_name']);
            }
        ])->first();

        if ( ! $post) return null;

        $post->user_name = $post->user->user_name; // method 1

        // $post = Post::find($postId);
        // $post->user_name = $post->user()->select(['user_name'])->first()->user_name; // method 2

        // $post->user_name = app(UserService::class)->getUserNameById($post->user_id); // method 3

        return $post;
    }

    public function postIndex()
    {
        $posts = Post::where('user_id', 10000001)
            ->sortByDesc('stick')
            ->get();

        return $posts;
    }

    /**
     * 帖子置顶
     * @param string | int $postId 帖子id
     * @param string | int $userId 用户id
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
     * @param $postId
     * @param $userId
     * @param $isFavor
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
}