<?php

namespace Modules\Posts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Documents\Entities\Document;

class Tag extends Model
{

    use SoftDeletes;

    protected $fillable = ['name', 'alias', 'class'];

    const CLASSES = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];


    public function setNameAttribute($value)
    {
        $this->attributes['name']  = $value;
        $this->attributes['alias'] = str_slug($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function documents()
    {
        return $this->belongsToMany(Document::class, 'document_tags');
    }
}
