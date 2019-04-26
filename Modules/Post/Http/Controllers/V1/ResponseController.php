<?php

namespace Modules\Post\Http\Controllers\V1;

use Illuminate\Http\Request;
use Modules\Post\Http\Controllers\BasePostController;
use Modules\Post\Models\Comment;
use Modules\Post\Models\Response;
use Modules\Post\Services\ResponseService;
use Modules\Post\Transformers\ResponseTransformer;

class ResponseController extends BasePostController
{
    /**
     * @var responseService 回复服务
     */
    private $responseService;

    /**
     * 构造函数
     * responseService constructor.
     * @param responseService $responseService
     */
    public function __construct(responseService $responseService)
    {
        $this->responseService = $responseService;
    }

    /**
     * 发表回复
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(Request $request)
    {
        $this->requestValidator($request, [
            'post_id' => 'required|int',
            'comment_id' => 'required|int',
            'respondent_id' => 'int',
            'content' => 'required|string'
        ]);

        $userId = $request->user()->id;
        $postId = $request->input('post_id');
        $commentId = $request->input('comment_id');
        $respondentId = $request->input('respondent_id', 0);
        $content = $request->input('content');

        $this->responseService->responseIssue($userId, $postId, $commentId, $respondentId, $content);

        return $this->response()->created();
    }

    /**
     * 删除回复
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->requestValidator($request, [
            'post_id' => 'required|int',
            'comment_id' => 'required|int',
            'response_id' => 'required|int'
        ]);

        $postId = $request->input('post_id');
        $commentId = $request->input('comment_id');
        $responseId = $request->input('response_id');
        $this->responseService->responseDelete($postId, $commentId, $responseId);
        return $this->response()->noContent();
    }

    /**
     * 恢复回复
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function restore(Request $request)
    {
        $this->requestValidator($request, [
            'post_id' => 'required|int',
            'comment_id' => 'required|int',
            'response_id' => 'required|int'
        ]);

        $postId = $request->input('post_id');
        $commentId = $request->input('comment_id');
        $responseId = $request->input('response_id');
        $this->responseService->responseRecover($postId, $commentId, $responseId);
        return $this->response()->created();
    }

    /**
     * 回复点赞/取消点赞
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function favor(Request $request)
    {
        // 校验参数
        $this->requestValidator($request, [
            'post_id' => 'required|int', //帖子id
            'comment_id' => 'required|int', // 评论id
            'response_id' => 'required|int', // 回复id
            'is_favor' => 'required|boolean', // 是否点赞
        ]);

        $userId = $request->user()->id;
        $postId = $request->input('post_id');
        $commentId = $request->input('comment_id');
        $responseId = $request->input('response_id');
        $isFavor = $request->input('is_favor');

        $this->responseService->switchFavor($postId, $commentId, $responseId, $userId, $isFavor);

        return $this->response()->noContent();
    }

    /**
     * 回复列表
     * @param int | string $postId 帖子id
     * @param int | string $commentId 评论id
     * @return \Dingo\Api\Http\Response
     */
    public function index($postId, $commentId)
    {
        $commentAbstract = mb_substr(Comment::findOrFail($commentId)->content, 0, 50);

        $paginator = app(Response::class)
            ->where('comment_id', $commentId)
            ->paginate(20);

        return $this->response
            ->paginator($paginator, new ResponseTransformer())
            ->setMeta(['comment_abstract' => $commentAbstract])
            ->setStatusCode(200);
    }
}
