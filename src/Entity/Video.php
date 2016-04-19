<?php
declare(strict_types=1);

namespace Firefly\Entity;

use Firefly\EntityTrait;

class Video
{
    use EntityTrait;
    public $content = [
        'contentType' => 3
    ];

    public function setOriginalContentUrl($url)
    {
        $this->content['originalContentUrl'] = (string)$url;
    }

    public function setPreviewImageUrl($url)
    {
        $this->content['previewImageUrl'] = (string)$url;
    }
}