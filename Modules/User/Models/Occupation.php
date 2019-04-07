<?php

namespace Modules\User\Models;

use Modules\Core\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Occupation extends BaseModel
{
    use softDeletes;
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
    protected $table = 'occupations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'creator_id',
    ];

}
