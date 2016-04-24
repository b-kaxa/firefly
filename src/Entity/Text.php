<?php
declare(strict_types = 1);

namespace Firefly\Entity;

use Firefly\EntityTrait;

class Text
{
    use EntityTrait;

    public function setText(string $text)
    {
        $this->content['text'] = $text;
    }
}