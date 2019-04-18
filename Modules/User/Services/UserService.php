<?php
/**
 * Created by PhpStorm.
 * User: LONG
 * Date: 2019/4/11
 * Time: 0:43
 */

namespace Modules\User\Services;

use Modules\User\Models\User;

class UserService
{
    private function findUserById($userId)
    {
        $user = User::find($userId);

        return $user;
    }

    public function getUserNameById($userId)
    {
        $user = $this->findUserById($userId);

        return $user->user_name;
    }

    public function getNotPasswordUser($userId)
    {
        $user = $this->findUserById($userId);
        $user->password = null;

        return $user;
    }

}