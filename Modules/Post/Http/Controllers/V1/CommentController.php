<?php

namespace Modules\Post\Http\Controllers\V1;

use Illuminate\Http\Request;
use Modules\Post\Http\Controllers\BasePostController;
use Modules\Post\Models\Comment;
use Modules\Post\Services\CommentService;
use Modules\Post\Transformers\CommentTransformer;

class CommentController extends BasePostController
{
    /**
     * @var commentService 评论服务
     */
    private $commentService;

    /**
     * 构造函数
     * commentService constructor.
     * @param commentService $commentService
     */
    public function __construct(commentService $commentService)
    {
        $this->commentService = $commentService;
    }
    
    public function store()
    {

    }

    public function destroy()
    {

    }

    public function restore()
    {

    }

    public function favor(Request $request)
    {
        // 校验参数
        $this->requestValidator($request, [
            'comment_id' => 'required|int', // 评论id
            'is_favor' => 'required|boolean', // 是否点赞
        ]);

        $userId = $request->user()->id;
        $commentId = $request->input('comment_id');
        $isFavor = $request->input('is_favor');

        $this->commentService->switchFavor($commentId, $userId, $isFavor);

        return $this->response()->noContent();
    }

    public function show($commentId)
    {
        $comment = $this->commentService->commentShow($commentId);

        return $this->response
            ->item($comment, new CommentTransformer())
            ->setStatusCode(200);
    }

    public function index()
    {
        $comments = Comment::where('post_id', 1)
            ->select([
                'user_id',
                'content',
                'responses_ids_cache',
                'created_at'
            ])
            ->get();

        return $this->response
            ->collection($comments, new CommentTransformer())
            ->setStatusCode(200);
    }
}
