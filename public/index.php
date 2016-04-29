<?php
use Firefly\Application as Firefly;

require_once __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/../src/config.php';

$app = new Firefly($config);
$receive_message = $app->getMessage();

// example
$entity = null;

if ($receive_message->checkMessageKind('Text') && $receive_message->hasText('twitter')) {
    $rich_message = $app->generateRichMessage($receive_message);
    $rich_message_detail = $app->generateRichMessageDetail();
    $metadata = [
        'ALT_TEXT' => 'alt text'
    ];

    $rich_message->setContentMetaData($metadata, $rich_message_detail);

//    $app->sendMessage($rich_message->getResponseData());
    exit;
};

exit(1);
