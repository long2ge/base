<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\BaseModel;
use Modules\User\Models\User;

class Comment extends BaseModel
{
    use SoftDeletes;
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
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'post_id',
        'content',
        'response_ids_cache',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function response()
    {
        return $this->hasMany(Response::class);
    }

    public function commentFavor()
    {
        return $this->hasMany(CommentFavor::class);
    }

    public function speechRecord()
    {
        return $this->hasMany(SpeechRecord::class);
    }
}
