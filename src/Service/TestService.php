<?php
declare(strict_types = 1);

namespace Firefly\Service;

class TestService extends AbstractService
{
    public function generateEntity(): array
    {
        $rich_message = $this->generateRichMessage();
        $rich_message_detail = $this->generateRichMessageDetail();

        $metadata = [
            'ALT_TEXT' => 'リッチテキストが送信されました'
        ];
        $rich_message->setContentMetaData($metadata, $rich_message_detail);

        return $rich_message->getResponseData();
    }
}