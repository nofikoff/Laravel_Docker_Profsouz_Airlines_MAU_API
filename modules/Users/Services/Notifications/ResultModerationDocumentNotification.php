<?php

namespace Modules\Users\Services\Notifications;

use Modules\Documents\Entities\Document;

class ResultModerationDocumentNotification extends BaseEntityNotification
{

    public function __construct(Document $document)
    {
        $this->event              = 'document_result_moderation';
        $this->entity             = $document;
        $this->is_urgent          = true;
        $this->is_sms             = true;
        $this->url                = $document->download_url;
        $this->message_trans_key  = $document->status == Document::STATUS_PUBLISHED ?
            'users::notifications.success_moderation_document' :
            'users::notifications.fail_moderation_document';
        $this->message_trans_data = ['file' => $document->file];

    }

    public function getType(): string
    {
        return $this->entity->status == Document::STATUS_PUBLISHED ? 'success' : 'error';
    }

}