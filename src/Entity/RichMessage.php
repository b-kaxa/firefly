<?php
declare(strict_types = 1);

namespace Firefly\Entity;

class RichMessage
{
    use EntityTrait;

    public function setContentMetaData(array $metadata, RichMessageDetail $rich_message_detail)
    {
        $this->content['contentMetadata']['SPEC_REV'] = '1';
        $this->content['contentMetadata']['MARKUP_JSON'] = json_encode($rich_message_detail->getDetail());

        // fixme
        $current_url =
            (!empty($_SERVER["HTTPS"]) ? "http://" : "https://")
            . $_SERVER["HTTP_HOST"]
            . $_SERVER["REQUEST_URI"]
            . 'images/';

        $this->content['contentMetadata']['DOWNLOAD_URL'] = $current_url;
        $this->content['contentMetadata']['ALT_TEXT'] = $metadata['ALT_TEXT'];
    }

    public final function getResponseData(): array
    {
        return get_object_vars($this);
    }
}