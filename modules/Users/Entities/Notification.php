<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Modules\Users\Services\Notifications\CloseQuestionNotification;
use Modules\Users\Services\Notifications\ConfirmUserNotification;
use Modules\Users\Services\Notifications\CreateCommentNotification;
use Modules\Users\Services\Notifications\CreateDocumentNotification;
use Modules\Users\Services\Notifications\CreatePostNotification;
use Modules\Users\Services\Notifications\NeedModerationDocumentNotification;
use Modules\Users\Services\Notifications\NeedModerationPostNotification;
use Modules\Users\Services\Notifications\NoneReadEntityNotification;
use Modules\Users\Services\Notifications\RegisterUserNotification;
use Modules\Users\Services\Notifications\ResultModerationDocumentNotification;
use Modules\Users\Services\Notifications\ResultModerationPostNotification;
use Modules\Users\Services\Notifications\SendToPremoderateDocumentNotification;
use Modules\Users\Services\Notifications\SendToPremoderatePostNotification;
use Modules\Users\Services\Notifications\SetWinnerQuestionNotification;

class Notification extends Model
{

    use SoftDeletes;

    const TYPE_POST     = 'post';
    const TYPE_COMMENT  = 'comment';
    const TYPE_QUESTION = 'question';
    const TYPE_DOCUMENT = 'document';
    const TYPE_USER     = 'user';

    const EVENT_NOTIFICATIONS = [
        'post_created'                   => CreatePostNotification::class,
        'document_created'               => CreateDocumentNotification::class,
        'comment_created'                => CreateCommentNotification::class,
        'question_close'                 => CloseQuestionNotification::class,
        'post_need_moderation'           => NeedModerationPostNotification::class,
        'document_need_moderation'       => NeedModerationDocumentNotification::class,
        'user_register'                  => RegisterUserNotification::class,
        'post_result_moderation'         => ResultModerationPostNotification::class,
        'document_result_moderation'     => ResultModerationDocumentNotification::class,
        'post_send_to_premoderation'     => SendToPremoderatePostNotification::class,
        'document_send_to_premoderation' => SendToPremoderateDocumentNotification::class,
        'question_set_winner'            => SetWinnerQuestionNotification::class,
        'noneread_entity'                => NoneReadEntityNotification::class,
        'your_account_is_confirm'        => ConfirmUserNotification::class,
    ];

    protected $fillable = ['user_id', 'is_urgent', 'read', 'entity_id', 'entity_type', 'event'];

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

    /**
     * @return string
     */
    public function getTextAttribute()
    {
        if ($this->noty) {
            return $this->noty->getText($this->user->locale);
        }
    }

    /**
     * @return string
     */
    public function getSystemTextAttribute()
    {
        if ($this->noty) {
            return $this->noty->getSystemText($this->user->locale);
        }
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        if ($this->noty) {
            return $this->noty->getUrl();
        }
    }

    public function getNotyAttribute()
    {
        if (! array_key_exists($this->event, self::EVENT_NOTIFICATIONS)) {
            return null;
        }

        $className = self::EVENT_NOTIFICATIONS[$this->event];

        return new $className($this->entity);
    }

    /**
     * @param Builder $query
     * @return Builder mixed
     */
    public function scopeNoneUrgent($query)
    {
        return $query->where('is_urgent', 0);
    }

    /**
     * @param Builder $query
     * @return Builder mixed
     */
    public function scopeNoneRead($query)
    {
        return $query->where('read', 0);
    }

    /**
     * @param Builder $query
     * @return Builder mixed
     */
    public function scopeComments($query)
    {
        return $query->where('entity_type', self::TYPE_COMMENT);
    }

    /**
     * @param Builder $query
     * @return Builder mixed
     */
    public function scopePosts($query)
    {
        return $query->where('entity_type', self::TYPE_POST);
    }

    /**
     * @param Builder $query
     * @return Builder mixed
     */
    public function scopeDocuments($query)
    {
        return $query->where('entity_type', self::TYPE_DOCUMENT);
    }
}
