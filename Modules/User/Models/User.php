<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Laravel\Passport\HasApiTokens;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    use HasApiTokens;

    /**
     * The connection name for the model.
     * 库链接的配置名
     *
     * @var string
     */
    protected $connection = 'cloud_user';

    /**
     * Table Name
     * 表名
     *
     * @var string
     */
    protected $table = 'users';

    public function findForPassport($username)
    {
        return (new static())->where('user_name', $username)->first();
    }
    /**
     * 设置用来认证的密码字段
     * @return string
     */
    public function getAuthPassword() : string
    {
        return $this->password;
    }
}
