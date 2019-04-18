<?php

namespace Modules\Post\Http\Controllers\V1;

use Illuminate\Http\Request;
use Modules\Post\Http\Controllers\BasePostController;
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
            'response_id' => 'required|int', // 回复id
            'is_favor' => 'required|boolean', // 是否点赞
        ]);

        $userId = $request->user()->id;
        $responseId = $request->input('response_id');
        $isFavor = $request->input('is_favor');

        $this->responseService->switchFavor($responseId, $userId, $isFavor);

        return $this->response()->noContent();
    }

    public function show($responseId)
    {
        $response = $this->responseService->responseShow($responseId);

        return $this->response
            ->item($response, new ResponseTransformer())
            ->setStatusCode(200);
    }

    public function index()
    {
        $responses = Response::where('id', 1)
            ->select([
                'user_id',
                'respondent_id',
                'content',
                'created_at'
            ])
            ->get();

        return $this->response
            ->collection($responses, new ResponseTransformer())
            ->setStatusCode(200);
    }
}
