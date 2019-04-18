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
            'post_id' => 'required|int', // 帖子id
            'is_favor' => 'required|boolean', // 是否点赞
        ]);

        $userId = $request->user()->id;
        $postId = $request->input('post_id');
        $isFavor = $request->input('is_favor');

        $this->postService->switchFavor($postId, $userId, $isFavor);

        return $this->response()->noContent();
    }

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

    public function index()
    {
        $posts = $this->postService->postIndex();

        return $this->response
            ->collection($posts, new PostTransformer())
            ->setStatusCode(200);
    }
}
