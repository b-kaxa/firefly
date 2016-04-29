<?php
declare(strict_types = 1);

namespace Firefly;

use GuzzleHttp\Client;
use Firefly\Entity\ReceiveMessage;

class Application
{
    private $event_url;
    private $http_headers;
    private $proxy_url;

    public function __construct(array $config)
    {
        if (!isset($config['event_url'])) {
            // todo: throw exception
        }

        $this->event_url = $config['event_url'];
        $this->http_headers = [
            'Content-Type' => 'application/json; charset=UTF-8',
            'X-Line-ChannelID' => $config['line_channel_id'] ?? getenv('LINE_CHANNEL_ID') ?? '',
            'X-Line-ChannelSecret' => $config['line_channel_secret'] ?? getenv('LINE_CHANNEL_SECRET') ?? '',
            'X-Line-Trusted-User-With-ACL' => $config['line_channel_mid'] ?? getenv('LINE_CHANNEL_MID') ?? '',
        ];
        $this->proxy_url = $config['proxy_url'];
    }

    public function getMessages(): array
    {
        // todo: 本能的にやばさを感じるのでなんとかする
        $receive_message = json_decode(file_get_contents('php://input'), true);
        $receive_messages = [];

        foreach ($receive_message['result'] as $number => $content) {
            $receive_messages[] = new ReceiveMessage($content);
        }

        return $receive_messages;
    }

    public function sendMessage(array $body)
    {
        if (!$body) {
            // todo: throw exception
        }

        $client = new Client();
        $client->request('post', $this->event_url, [
            'headers' => $this->http_headers,
            'body' => json_encode($body),
            'proxy' => $this->getProxyUrl()
        ]);

        // todo: check response and logging
    }

    public function getProxyUrl(): array
    {
        $proxy_url = $this->proxy_url ?? getenv('PROXY_URL') ?? '';
        if (isset($proxy_url)) {
            return [
                'https' => $proxy_url
            ];
        }

        return [];
    }
}