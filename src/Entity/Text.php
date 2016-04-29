<?php
declare(strict_types = 1);

namespace Firefly\Entity;

class Text
{
    use EntityTrait;

    public function setText(string $text)
    {
        $this->content['text'] = $text;
    }
}