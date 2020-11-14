<?php

namespace Modules\Users\Services\Notifications;

use Modules\Documents\Entities\Document;

class CreateDocumentNotification extends BaseEntityNotification
{

    public function __construct(Document $document)
    {
        $this->event              = 'document_created';
        $this->entity             = $document;
        $this->is_urgent          = $document->importance;
        $this->message_trans_key  = 'users::notifications.new_document';
        $this->message_trans_data = ['file' => $document->file];
        $this->url                = $document->download_url;
        $this->excepted_user_ids  = [$document->user_id];
    }

}