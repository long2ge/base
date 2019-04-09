<?php

namespace Modules\User\Models;

use Modules\Core\Models\BaseModel;

class UserFans extends BaseModel
{
    /**
     * The connection name for the model
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
    protected $table = 'user_fans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'fan_id',
    ];

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;
}
