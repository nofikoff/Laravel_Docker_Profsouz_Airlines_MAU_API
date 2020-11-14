<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Page extends Model
{
    use Sortable;

    protected $fillable = ['title', 'alias', 'text', 'order', 'hide'];

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished($query)
    {
        return $query->where('hide', 0);
    }
}
