<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/4/18
 * Time: 20:02
 */

namespace Modules\Post\Services;

use Modules\Post\Models\Comment;
use Modules\Post\Models\CommentFavor;
// use Modules\User\Services\UserService; // method 3

class CommentService
{
    /**
     * @param string | int $commentId 评论id
     * @return null
     */
    public function commentShow($commentId)
    {
        $comment = Comment::where('id', $commentId)->with([
            'user' => function ($query) {
                $query->select(['user_name']);
            }
        ])->first();

        if ( ! $comment) return null;

        $comment->user_name = $comment->user->user_name; // method 1

        // $comment = Comment::find($commentId);
        // $comment->user_name = $comment->user()->select(['user_name'])->first()->user_name; // method 2

         $comment->user_name = app(UserService::class)->getUserNameById($comment->user_id); // method 3

        return $comment;
    }

    /**
     * 评论点赞
     * @param $commentId
     * @param $userId
     * @param $isFavor
     */
    public function switchFavor($commentId, $userId, $isFavor)
    {
        $isFavor ? CommentFavor::create([
            'comment_id' => $commentId,
            'user_id' => $userId,
        ])
            : CommentFavor::where('comment_id', $commentId)
            ->where('user_id', $userId)
            ->delete();
    }
}