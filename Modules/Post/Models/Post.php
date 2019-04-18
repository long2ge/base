<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\BaseModel;
use Modules\User\Models\User;

class Post extends BaseModel
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
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'content',
        'view',
        'stick',
        'source',
        'last_updated_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = ['stick' => 'boolean'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function postFavor()
    {
        return $this->hasMany(PostFavor::class);
    }

    public function speechRecord()
    {
        return $this->hasMany(SpeechRecord::class);
    }
}
