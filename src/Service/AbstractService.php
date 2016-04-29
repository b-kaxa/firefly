<?php
declare(strict_types = 1);

namespace Firefly\Service;

use Firefly\Entity\{
    Location, MultipleMessages, ReceiveMessage, RichMessage, RichMessageDetail, Video, Text, Image, Sticker
};

abstract class AbstractService
{
    public function generateText(ReceiveMessage $receive_message): Text
    {
        return new Text($receive_message, ReceiveMessage::CONTENT_TYPE['text']);
    }

    public function generateImage(ReceiveMessage $receive_message): Image
    {
        return new Image($receive_message, ReceiveMessage::CONTENT_TYPE['image']);
    }

    public function generateVideo(ReceiveMessage $receive_message): Video
    {
        return new Video($receive_message, ReceiveMessage::CONTENT_TYPE['video']);
    }

    public function generateLocation(ReceiveMessage $receive_message): Location
    {
        return new Location($receive_message, ReceiveMessage::CONTENT_TYPE['location']);
    }

    public function generateSticker(ReceiveMessage $receive_message): Sticker
    {
        return new Sticker($receive_message, ReceiveMessage::CONTENT_TYPE['sticker']);
    }

    public function generateRichMessage(ReceiveMessage $receive_message): RichMessage
    {
        return new RichMessage($receive_message, ReceiveMessage::CONTENT_TYPE['rich_message']);
    }

    public function generateRichMessageDetail(): RichMessageDetail
    {
        return new RichMessageDetail();
    }

    public function generateMultipleMessages(): MultipleMessages
    {
        return new MultipleMessages();
    }
}