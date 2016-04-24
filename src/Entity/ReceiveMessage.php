<?php
declare(strict_types = 1);

namespace Firefly\Entity;

class ReceiveMessage
{
    private $id;
    private $contentType;
    private $from;
    private $createdTime;
    private $to;
    private $toType;
    private $contentMetadata;
    private $text;
    private $location;
    private $params;
    private $revision;
    private $opType;

    const CONTENT_TYPE = [
        'text' => 1,
        'image' => 2,
        'video' => 3,
        'audio' => 4,
        'location' => 7,
        'sticker' => 8,
        'contact' => 10
    ];

    public function __construct(array $receive_message)
    {
        $this->id              = $receive_message['id'] ?? '';
        $this->contentType     = (int)($receive_message['contentType'] ?? 0);
        $this->from            = (string)($receive_message['from'] ?? '');
        $this->createdTime     = $receive_message['createTime'] ?? '';
        $this->to              = $receive_message['to'] ?? '';
        $this->toType          = $receive_message['toType'] ?? '';
        $this->contentMetadata = $receive_message['contentMetadata'] ?? '';
        $this->text            = $receive_message['text'] ?? '';
        $this->location        = $receive_message['location'] ?? '';
        $this->params          = (array)($receive_message['params'] ?? []);
        $this->revision        = (int)($receive_message['revision'] ?? 0);
        $this->opType          = (int)($receive_message['opType'] ?? 0);
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getContentType(): int
    {
        return $this->contentType;
    }

    public function getOpType(): int
    {
        return $this->opType;
    }

    public function getAddedOrBlockedUserMid(): string
    {
        return $this->params[0];
    }

    public function checkMessageKind(string $kind): bool
    {
        switch ($kind) {
            case 'Text':
                return $this->getContentType() === self::CONTENT_TYPE['text'];
            case 'Image':
                return $this->getContentType() === self::CONTENT_TYPE['image'];
            case 'Video':
                return $this->getContentType() === self::CONTENT_TYPE['video'];
            case 'Audio':
                return $this->getContentType() === self::CONTENT_TYPE['audio'];
            case 'Location':
                return $this->getContentType() === self::CONTENT_TYPE['location'];
            case 'Sticker':
                return $this->getContentType() === self::CONTENT_TYPE['sticker'];
            default:
                // todo: throw exception
                return false;
        }
    }

    public function checkOperationType(string $kind): bool
    {
        switch ($kind) {
            case 'FriendAdd':
                return $this->getOpType() === 4;
            case 'Blocked':
                return $this->getOpType() === 8;
            default:
                // todo: throw exception
                return false;
        }
    }

    public function hasText(string $search_text): bool
    {
        return is_int(strpos($this->text, $search_text));
    }
}