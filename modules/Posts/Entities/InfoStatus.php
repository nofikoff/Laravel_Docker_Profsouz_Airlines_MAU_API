<?php

namespace Modules\Posts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfoStatus extends Model
{

    protected $fillable = ['ru', 'uk', 'en'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'info_status_id', 'id');
    }

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->attributes[strtolower(\App::getLocale())] ?? '';
    }
}
