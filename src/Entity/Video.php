<?php
declare(strict_types = 1);

namespace Firefly\Entity;

class Video
{
    use EntityTrait;

    public function setOriginalContentUrl(string $url)
    {
        $this->content['originalContentUrl'] = $url;
    }

    public function setPreviewImageUrl(string $url)
    {
        $this->content['previewImageUrl'] = $url;
    }
}