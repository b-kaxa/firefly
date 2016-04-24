<?php
declare(strict_types=1);

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

    public function __construct(array $receive_message)
    {
        $this->id              = $receive_message['id'] ?? '';
        $this->contentType     = (int)$receive_message['contentType'] ?? '';
        $this->from            = (string)$receive_message['from'] ?? '';
        $this->createdTime     = $receive_message['createTime'] ?? '';
        $this->to              = $receive_message['to'] ?? '';
        $this->toType          = $receive_message['toType'] ?? '';
        $this->contentMetadata = $receive_message['contentMetadata'] ?? '';
        $this->text            = $receive_message['text'] ?? '';
        $this->location        = $receive_message['location'] ?? '';
        $this->params          = $receive_message['params'] ?? '';
        $this->revision        = $receive_message['revision'] ?? '';
        $this->opType          = (int)$receive_message['opType'] ?? '';
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

    public function getAddedOrBlockedUserMid()
    {
        return $this->params[0];
    }

    public function checkMessageKind(string $kind): bool
    {
        switch ($kind) {
            case 'Text':
                return $this->getContentType() === 1;
            case 'Image':
                return $this->getContentType() === 2;
            case 'Video':
                return $this->getContentType() === 3;
            case 'Audio':
                return $this->getContentType() === 4;
            case 'Location':
                return $this->getContentType() === 7;
            case 'Sticker':
                return $this->getContentType() === 8;
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