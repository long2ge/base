<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/3/19
 * Time: 1:18
 */

namespace Modules\User\Http\Controllers\V1;

use Modules\User\Http\Controllers\BaseUserController;
use Modules\User\Models\User;
use Modules\User\Models\UserFans;
use Modules\User\Transformers\UserFansTransformer;

class TestController extends BaseUserController
{
    public function test()
    {
        $paginator = app(UserFans::class)
            ->where('user_id', 10000001)
            ->latest()
            ->paginate(10);

        return $this->response
            ->paginator($paginator, new UserFansTransformer())
            ->setStatusCode(200);
    }

    public function fans()
    {
        $paginator = app(UserFans::class)
            ->where('user_id', 10000001)
            ->latest()
            ->paginate(10);

        return $this->response
            ->paginator($paginator, new UserFansTransformer())
            ->setStatusCode(200);
    }

    public function concerns()
    {
        $paginator = app(UserFans::class)
            ->where('fan_id', 1)
            ->latest()
            ->get();

        return $this->response
            ->collection($paginator, new UserFansTransformer())
            ->setStatusCode(200);
    }

    public function info()
    {
        $user = app(User::class)->where('id', 10000001)->first();

        return [
            'user_name' => $user->user_name,
            'profile' => $user->profile,
            'phone_number' => $user->phone_number,
            'fans' => $user->userFans()->count(),
            'concerns' => $user->userConcerns()->count()
        ];
    }
}