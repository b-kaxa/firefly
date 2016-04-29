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
            'X-Line-ChannelID' => getenv('LINE_CHANNEL_ID') ?? $config['line_channel_id'],
            'X-Line-ChannelSecret' => getenv('LINE_CHANNEL_SECRET') ?? $config['line_channel_secret'],
            'X-Line-Trusted-User-With-ACL' => getenv('LINE_CHANNEL_MID') ?? $config['line_channel_mid'],
        ];
        $this->proxy_url = $config['proxy_url'];
    }

    public function getMessages(): array
    {
        // todo: 本能的にやばさを感じるのでなんとかする
        $receive_data = json_decode(file_get_contents('php://input'), true);
        $receive_messages = [];

        foreach ($receive_data['result'] as $receive_message) {
            $receive_messages[] = new ReceiveMessage($receive_message['content']);
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
        $proxy_url = getenv('PROXY_URL') ?? $this->proxy_url;
        if (isset($proxy_url)) {
            return [
                'https' => $proxy_url
            ];
        }

        return [];
    }
}