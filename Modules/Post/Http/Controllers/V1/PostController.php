<?php

namespace Modules\Post\Http\Controllers\V1;

use Modules\Post\Http\Controllers\BasePostController;
use Modules\Post\Models\Post;
use Modules\Post\Services\PostService;
use Modules\Post\Transformers\PostTransformer;
use Illuminate\Http\Request;

class PostController extends BasePostController
{
    /**
     * @var PostService 帖子服务
     */
    private $postService;

    /**
     * 构造函数
     * PostService constructor.
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * 发表帖子
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(Request $request)
    {
        $this->requestValidator($request, [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $userId = $request->user()->id;
        $title = $request->input('title');
        $content = $request->input('content');

        $this->postService->postIssue($userId, $title, $content);

        return $this->response()->created();
    }

    /**
     * 删除帖子
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->requestValidator($request, ['post_id' => 'required|int']);
        $postId = $request->input('post_id');
        $this->postService->postDelete($postId);
        return $this->response()->noContent();
    }

    /**
     * 恢复帖子
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function restore(Request $request)
    {
        $this->requestValidator($request, ['post_id' => 'required|int']);
        $postId = $request->input('post_id');
        $this->postService->postRecover($postId);
        return $this->response()->created();
    }

    /**
     * 帖子点赞/取消点赞
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function favor(Request $request)
    {
        // 校验参数
        $this->requestValidator($request, [
            'post_id' => 'required|int', // 帖子id
            'is_favor' => 'required|boolean', // 是否点赞
        ]);

        $userId = $request->user()->id;
        $postId = $request->input('post_id');
        $isFavor = $request->input('is_favor');

        $this->postService->switchFavor($postId, $userId, $isFavor);

        return $this->response()->noContent();
    }

    /**
     * 帖子置顶/取消置顶
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function stick(Request $request)
    {
        // 校验参数
        $this->requestValidator($request, [
            'post_id' => 'required|int', // 帖子id
            'is_stick' => 'required|boolean', // 是否置顶
        ]);

        $userId = $request->user()->id;
        $postId = $request->input('post_id');
        $isStick = $request->input('is_stick');

        $this->postService->switchStick($postId, $userId, $isStick);

        return $this->response()->noContent();
    }

    /**
     * 显示单条帖子
     * @param int | string $postId 帖子id
     * @return \Dingo\Api\Http\Response
     */
    public function show($postId)
    {
        $post = $this->postService->postShow($postId);

        if ($post) {
            $post->increment('view');
        }

        return $this->response
            ->item($post, new PostTransformer())
            ->setStatusCode(200);
    }

    /**
     * 显示帖子列表
     * @param int | string $userId 用户id
     * @return \Dingo\Api\Http\Response
     */
    public function index($userId)
    {
        $paginator = app(Post::class)
            ->where('user_id', $userId)
            ->sortByDesc('stick')
            ->latest()
            ->paginate(20);

        return $this->response
            ->paginator($paginator, new PostTransformer(['type' => 'index']))
            ->setStatusCode(200);
    }
}
