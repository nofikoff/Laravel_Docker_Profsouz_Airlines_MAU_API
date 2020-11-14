<?php

namespace Modules\Documents\Observers;

use Modules\Documents\Entities\Document;
use Modules\Users\Entities\Log;
use Modules\Users\Services\Notifications\CreateDocumentNotification;
use Modules\Users\Services\Notifications\NeedModerationDocumentNotification;
use Modules\Users\Services\Notifications\ResultModerationDocumentNotification;
use Modules\Users\Services\Notifications\SendToPremoderateDocumentNotification;
use Storage;

class DocumentObserver
{

    public function saving(Document $document)
    {
        if ($document->status === Document::STATUS_PUBLISHED) {
            if (\Auth::user()) {
                if (! \Auth::user()->can('publishing', $document->branch)) {
                    $document->status = Document::STATUS_PREMODERATION;
                }
            }
        }
    }

    public function saved(Document $document)
    {
        if ($document->status === Document::STATUS_PUBLISHED) {
            if (! $document->notifications()->exists()) {
                app('notification',
                    ['notification' => new CreateDocumentNotification($document)])->toBranch($document->branch);
            }
        } else {
            $document->notifications()->noneRead()->delete();
            app('notification',
                ['notification' => new SendToPremoderateDocumentNotification($document)])->toUser($document->user);
            app('notification',
                ['notification' => new NeedModerationDocumentNotification($document)])->toBranchModerators($document->branch);
        }

        if ($document->isDirty('status') && $document->getOriginal('status') == Document::STATUS_PREMODERATION) {
            app('notification', ['notification' => new ResultModerationDocumentNotification($document)])->toUser($document->user);
        }

    }

    public function created(Document $document)
    {
        if (! \App::runningInConsole()) {
            $ip = \Request::getClientIp();

            $document->logs()->create([
                'user_id' => \Auth::id(),
                'type'    => Log::TYPE_CREATE,
                'ip'      => $ip
            ]);
        }
    }

    public function deleting(Document $document)
    {
        /**
         * Удаление документа, который лежит в Storage
         */
        $file_path = 'public/'.trim(Document::STORAGE_PATH, '/').'/'.$document->url;
        if (Storage::exists($file_path)) {
            Storage::delete($file_path);
        }

        $document->notifications()->delete();
    }

    public function deleted(Document $document)
    {
        if (! \App::runningInConsole()) {
            $ip = \Request::getClientIp();

            $document->logs()->create([
                'user_id' => \Auth::id(),
                'type'    => Log::TYPE_DELETE,
                'value'   => $document->title,
                'ip'      => $ip
            ]);
        }
    }

    public function updating(Document $document)
    {
        if (! \App::runningInConsole()) {
            $dirties = [
                'description' => Log::CHANGE_BODY,
                'branch_id'   => Log::CHANGE_BRANCH,
                'status'      => Log::CHANGE_STATUS,
            ];

            foreach ($dirties as $key => $value) {
                $this->checkDirty($document, $key, $value);
            }
        }
    }

    public function checkDirty(Document $document, $column, $type)
    {
        if ($document->isDirty($column)) {
            $document->logs()->create([
                'user_id' => \Auth::id(),
                'type'    => $type,
                'value'   => $document->$column,
                'comment' => request('log_comment'),
                'ip'      => \Request::getClientIp()
            ]);
        }
    }
}