<?php
declare(strict_types = 1);

namespace Firefly\Service;

class TestService extends AbstractService
{
    public function generateEntity()
    {
        $rich_message = $this->generateRichMessage();
        $rich_message_detail = $this->generateRichMessageDetail();

        $metadata = [
            'ALT_TEXT' => 'alt text'
        ];
        $rich_message->setContentMetaData($metadata, $rich_message_detail);

        $this->setResponseData($rich_message->getResponseData());
    }
}