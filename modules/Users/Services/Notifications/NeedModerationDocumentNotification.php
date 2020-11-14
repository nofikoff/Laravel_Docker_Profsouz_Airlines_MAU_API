<?php

namespace Modules\Users\Services\Notifications;

use Modules\Documents\Entities\Document;

class NeedModerationDocumentNotification extends BaseEntityNotification
{

    public function __construct(Document $document)
    {
        $this->event              = 'document_need_moderation';
        $this->entity             = $document;
        $this->is_urgent          = true;
        $this->is_sms             = true;
        $this->message_trans_key  = 'users::notifications.need_moderation_document';
        $this->message_trans_data = ['file' => $document->file];
        $this->url                = $document->download_url;
    }

}