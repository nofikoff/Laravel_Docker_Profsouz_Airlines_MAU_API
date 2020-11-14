<?php

namespace Modules\Posts\Observers;

use Modules\Posts\Entities\Post;
use Modules\Users\Entities\Log;
use Modules\Users\Services\Notifications\CreatePostNotification;
use Modules\Users\Services\Notifications\NeedModerationPostNotification;
use Modules\Users\Services\Notifications\ResultModerationPostNotification;
use Modules\Users\Services\Notifications\SendToPremoderatePostNotification;

class PostObserver
{

    public function deleting(Post $post)
    {
        foreach ($post->comments as $comment) {
            $comment->delete();
        }

        $post->notifications()->delete();
    }

    public function saving(Post $post)
    {
        $post->importance = $post->sms_notify ? true : false;
        $post->in_top     = $post->sms_notify ? true : false;

        if ($post->status === Post::STATUS_PUBLISHED) {
            if (\Auth::user()) {
                if (! \Auth::user()->can('publishing', $post->branch)) {
                    $post->status = Post::STATUS_PREMODERATION;
                }
            }
        }

        if (empty($post->getDirty()) && request('log_comment', false)) {
            $post->logs()->create([
                'user_id' => \Auth::id(),
                'type'    => Log::TYPE_COMMENT,
                'comment' => request('log_comment'),
                'ip'      => \Request::getClientIp()
            ]);
        }
    }

    /**
     * @param Post $post
     */
    public function saved(Post $post)
    {
        if ($post->is_published) {
            if (! $post->notifications()->count()) {
                app('notification', ['notification' => new CreatePostNotification($post)])->toBranch($post->branch);
            }
        } else {
            $post->notifications()->noneRead()->delete();
            if ($post->status === Post::STATUS_PREMODERATION) {
                app('notification',
                    ['notification' => new SendToPremoderatePostNotification($post)])->toUser($post->user);
                app('notification',
                    ['notification' => new NeedModerationPostNotification($post)])->toBranchModerators($post->branch);
            }
        }

        if ($post->isDirty('status') && $post->getOriginal('status') == Post::STATUS_PREMODERATION) {
            app('notification', ['notification' => new ResultModerationPostNotification($post)])->toUser($post->user);
        }
    }

    public function created(Post $post)
    {
        if (! \App::runningInConsole()) {
            $ip = \Request::getClientIp();

            $post->logs()->create([
                'user_id' => \Auth::id(),
                'type'    => Log::TYPE_CREATE,
                'ip'      => $ip
            ]);
        }
    }

    public function deleted(Post $post)
    {
        if (! \App::runningInConsole()) {
            $ip = \Request::getClientIp();

            $post->logs()->create([
                'user_id' => \Auth::id(),
                'type'    => Log::TYPE_DELETE,
                'value'   => $post->title,
                'ip'      => $ip
            ]);
        }
    }

    public function updating(Post $post)
    {
        if (! \App::runningInConsole()) {
            $dirties = [
                'title'          => Log::CHANGE_TITLE,
                'body'           => Log::CHANGE_BODY,
                'branch_id'      => Log::CHANGE_BRANCH,
                'info_status_id' => Log::CHANGE_INFOSTATUS,
                'status'         => Log::CHANGE_STATUS,
            ];

            foreach ($dirties as $key => $value) {
                $this->checkDirty($post, $key, $value);
            }
        }
    }

    public function checkDirty(Post $post, $column, $type)
    {
        if ($post->isDirty($column)) {
            $post->logs()->create([
                'user_id' => \Auth::id(),
                'type'    => $type,
                'value'   => $column === 'info_status_id' ? $post->$column : $post->getOriginal($column),
                'comment' => request('log_comment'),
                'ip'      => \Request::getClientIp()
            ]);
        }
    }
}