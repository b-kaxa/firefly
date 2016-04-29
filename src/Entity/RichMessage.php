<?php
declare(strict_types = 1);

namespace Firefly\Entity;

use Firefly\EntityTrait;

class RichMessage
{
    use EntityTrait;

    public $content = [
        'SPEC_REV' => '1',
        'MARKUP_JSON' => ''
    ];

    public function setContentMetaData(array $metadata, RichMessageDetail $rich_message_detail)
    {
        $this->content['contentMetadata']['MARKUP_JSON'] = json_encode($rich_message_detail->getDetail());
        $this->content['contentMetadata']['DOWNLOAD_URL'] = $metadata['DOWNLOAD_URL'];
        $this->content['contentMetadata']['ALT_TEXT'] = $metadata['ALT_TEXT'];
    }

    public final function getResponseData(): array
    {
        return get_object_vars($this);
    }
}