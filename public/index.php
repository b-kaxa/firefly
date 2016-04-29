<?php
use Firefly\Application as Firefly;
use Firefly\Service\{
    TestService
};

require_once __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/../src/config.php';

$app = new Firefly($config);
$receive_messages = $app->getMessages();

/* @var $receive_message \Firefly\Entity\ReceiveMessage */
foreach ($receive_messages as $receive_message) {
    $entity = null;

    if ($receive_message->checkMessageKind('Text') && $receive_message->hasText('test')) {
        $entity = new TestService($receive_message);
    }

    // write here some cases ...

    if (!is_null($entity)) {
        $app->sendMessage($entity->getResponseData());
    }
}