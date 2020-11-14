<?php

namespace Modules\Users\Services\Notifications;

use Modules\Documents\Entities\Document;

class SendToPremoderateDocumentNotification extends BaseEntityNotification
{

    public function __construct(Document $document)
    {
        $this->event              = 'document_send_to_premoderation';
        $this->entity             = $document;
        $this->is_urgent          = true;
        $this->message_trans_key  = 'users::notifications.premoderate_document';
        $this->message_trans_data = [];
        $this->url                = '#';
    }

}