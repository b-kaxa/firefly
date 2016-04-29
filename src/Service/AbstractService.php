<?php
declare(strict_types = 1);

namespace Firefly\Service;

use Firefly\Entity\{
    Location, MultipleMessages, ReceiveMessage, RichMessage, RichMessageDetail, Video, Text, Image, Sticker
};

abstract class AbstractService
{
    private $receive_message;
    private $response_data;

    public function __construct(ReceiveMessage $receive_message)
    {
        $this->receive_message = $receive_message;
        $this->response_data = $this->generateEntity();
    }

    public function generateText(): Text
    {
        return new Text($this->receive_message, ReceiveMessage::CONTENT_TYPE['text']);
    }

    public function generateImage(): Image
    {
        return new Image($this->receive_message, ReceiveMessage::CONTENT_TYPE['image']);
    }

    public function generateVideo(): Video
    {
        return new Video($this->receive_message, ReceiveMessage::CONTENT_TYPE['video']);
    }

    public function generateLocation(): Location
    {
        return new Location($this->receive_message, ReceiveMessage::CONTENT_TYPE['location']);
    }

    public function generateSticker(): Sticker
    {
        return new Sticker($this->receive_message, ReceiveMessage::CONTENT_TYPE['sticker']);
    }

    public function generateRichMessage(): RichMessage
    {
        return new RichMessage($this->receive_message, ReceiveMessage::CONTENT_TYPE['rich_message']);
    }

    public function generateRichMessageDetail(): RichMessageDetail
    {
        return new RichMessageDetail();
    }

    public function generateMultipleMessages(): MultipleMessages
    {
        return new MultipleMessages();
    }

    abstract function generateEntity(): array;

    public final function getResponseData(): array
    {
        return $this->response_data;
    }
}