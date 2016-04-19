<?php
declare(strict_types=1);

namespace Firefly\Entity;

use Firefly\EntityTrait;

class Audio
{
    use EntityTrait;
    public $content = [
        'contentType' => 4,
        'contentMetadata' => [
            'AUDLEN' => '240000'
        ]
    ];

    public function setOriginalContentUrl($url)
    {
        $this->content['originalContentUrl'] = (string)$url;
    }
}