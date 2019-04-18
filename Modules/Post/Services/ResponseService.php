<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/4/18
 * Time: 20:02
 */

namespace Modules\Post\Services;

use Modules\Post\Models\Response;
use Modules\Post\Models\ResponseFavor;
// use Modules\User\Models\User; // method 3

class ResponseService
{
    /**
     * @param string | int $responseId 回复id
     * @return null
     */
    public function responseShow($responseId)
    {
        $response = Response::where('id', $responseId)->with([
            'user' => function ($query) {
                $query->select(['user_name']);
            }
        ])->first();

        if ( ! $response) return null;
        $response->user_name = $response->user->user_name; // method 1

        // $response = Response::find($responseId);
        // $response->user_name = $response->user()->select(['user_name'])->first()->user_name; // method 2

        // $response->user_name = app(UserService::class)->getUserNameById($response->user_id); // method 3

        return $response;
    }

    /**
     * 回复点赞
     * @param $responseId
     * @param $userId
     * @param $isFavor
     */
    public function switchFavor($responseId, $userId, $isFavor)
    {
        $isFavor ? ResponseFavor::create([
            'response_id' => $responseId,
            'user_id' => $userId,
        ])
            : ResponseFavor::where('response_id', $responseId)
            ->where('user_id', $userId)
            ->delete();
    }
}