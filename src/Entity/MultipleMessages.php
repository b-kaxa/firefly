<?php
declare(strict_types = 1);

namespace Firefly\Entity;

class MultipleMessages
{
    public $to;
    public $toChannel = 1383378250;
    public $eventType = '140177271400161403';
    public $content = [
        'messageNotified' => 0,
        'messages' => []
    ];

    public function setTo(string $to)
    {
        $this->to = [$to];
    }

    public function setMessage(array $message)
    {
        unset($message['toType']);
        $this->content['messages'][] = $message;
    }

    public function getResponseData(): array
    {
        return get_object_vars($this);
    }
}