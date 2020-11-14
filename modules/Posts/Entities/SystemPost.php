<?php

namespace Modules\Posts\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\User;

class SystemPost extends Model
{
    protected $fillable = ['user_id', 'body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
