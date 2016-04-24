<?php
declare(strict_types = 1);

namespace Firefly\Entity;

use Firefly\EntityTrait;

class Audio
{
    use EntityTrait;
    public $content = [
        'contentMetadata' => [
            'AUDLEN' => '240000'
        ]
    ];

    public function setOriginalContentUrl(string $url)
    {
        $this->content['originalContentUrl'] = $url;
    }
}