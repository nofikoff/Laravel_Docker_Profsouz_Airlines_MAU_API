<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Posts\Entities\Post;

class Log extends Model
{

    protected $fillable = ['ip', 'user_id', 'type', 'value', 'comment'];

    const TYPE_LOGIN  = 'login';
    const TYPE_LOGOUT = 'logout';

    const TYPE_CREATE = 'create';
    const TYPE_DELETE = 'delete';

    const CHANGE_TITLE      = 'title';
    const CHANGE_BODY       = 'body';
    const CHANGE_BRANCH     = 'branch';
    const CHANGE_INFOSTATUS = 'infostatus';
    const CHANGE_STATUS     = 'status';

    const TYPE_COMMENT = 'comment';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function entity()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
