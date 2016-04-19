<?php
declare(strict_types=1);

namespace Firefly;

use Firefly\Entity\ReceiveMessage;

Trait EntityTrait
{
    public $to;
    public $toChannel = 1383378250;
    public $eventType = '138311608800106203';

    public function __construct(ReceiveMessage $receive_message)
    {
        // todo: なんとかする
        $this->to = [$receive_message->getFrom()];
        $this->content['toType'] = 1;
    }

    public function setTo(string $to)
    {
        $this->to = $to;
    }

    public function setContentType(int $content_type)
    {
        $this->content['contentType'] = $content_type;
    }

    public function getResponseData(): array
    {
        return get_object_vars($this);
    }
}
