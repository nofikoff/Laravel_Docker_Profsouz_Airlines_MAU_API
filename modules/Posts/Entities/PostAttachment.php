<?php

namespace Modules\Posts\Entities;

use Illuminate\Database\Eloquent\Model;

class PostAttachment extends Model
{
    protected $fillable = ['name', 'file'];
    protected $appends = ['type'];

    const TYPE_IMAGE = 'image';
    const TYPE_FILE = 'file';

    /**
     * @return string
     */
    public function getDownloadUrlAttribute()
    {
        return route('posts.download-attachment', ['attachment_id' => $this->id]);
    }

    /**
     * @return string
     */
    public function getTypeAttribute()
    {
        $supported_image = ['gif', 'jpg', 'jpeg', 'png'];
        $ext = strtolower(pathinfo($this->file, PATHINFO_EXTENSION));
        return in_array($ext, $supported_image) ? self::TYPE_IMAGE : self::TYPE_FILE;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
