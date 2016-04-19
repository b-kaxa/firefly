<?php
declare(strict_types=1);

namespace Firefly\Entity;

use Firefly\EntityTrait;

class Location
{
    use EntityTrait;
    public $content = [
        'contentType' => 7
    ];

    public function setText(string $text)
    {
        $this->content['text'] = $text;
    }

    public function setLocation(array $location)
    {
        $this->content['location']['title'] = $location['title'];
        $this->content['location']['latitude'] = $location['latitude'];
        $this->content['location']['longitude'] = $location['longitude'];
    }
}