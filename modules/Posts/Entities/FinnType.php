<?php

namespace Modules\Posts\Entities;

use Illuminate\Database\Eloquent\Model;

class FinnType extends Model
{
    protected $fillable = ['ru', 'en', 'uk'];

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->attributes[strtolower(\App::getLocale())] ?? '';
    }
}
