<?php
declare(strict_types=1);

namespace Firefly\Entity;

use Firefly\EntityTrait;

class Text
{
    use EntityTrait;
    public $content = [
        'contentType' => 1
    ];

    public function setText(string $text)
    {
        $this->content['text'] = $text;
    }
}