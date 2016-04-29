<?php
declare(strict_types = 1);

namespace Firefly;

use GuzzleHttp\Client;
use Firefly\Entity\{
    Location, MultipleMessages, ReceiveMessage, RichMessage, RichMessageDetail, Video, Text, Image, Sticker
};

class Application
{
    const CONTENTS_TYPE = 'application/json; charset=UTF-8';

    private $event_url;

    public function __construct(array $config)
    {
        if (!isset($config['event_url'])) {
            // todo: throw exception
        }

        $this->event_url = $config['event_url'];
    }

    public function getMessage(): ReceiveMessage
    {
        // todo: 本能的にやばさを感じるのでなんとかする
        $receive_message = json_decode(file_get_contents('php://input'), true);
        return new ReceiveMessage($receive_message['result'][0]['content']);
    }

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

    public function sendMessage(array $body)
    {
        if (!$body) {
            // todo: throw exception
        }

        $headers = $this->getHeaders();
        $body = $this->generateBody($body);
        $proxy = $this->getProxyUrl();

        $client = new Client();
        $client->request('post', $this->event_url, [
            'headers' => $headers,
            'body' => $body,
            'proxy' => $proxy
        ]);

        // todo: throw exception
    }

    public function generateBody(array $body)
    {
        return json_encode($body);
    }

    public function getHeaders(): array
    {
        return [
            'Content-Type' => self::CONTENTS_TYPE,
            'X-Line-ChannelID' => getenv('LINE_CHANNEL_ID'),
            'X-Line-ChannelSecret' => getenv('LINE_CHANNEL_SECRET'),
            'X-Line-Trusted-User-With-ACL' => getenv('LINE_CHANNEL_MID'),
        ];
    }

    public function getProxyUrl(): array
    {
        $proxy_url = getenv('PROXY_URL');
        if (isset($proxy_url)) {
            return [
                'https' => getenv('PROXY_URL')
            ];
        }

        return [];
    }
}