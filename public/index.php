<?php
use Firefly\Application as Firefly;
use Firefly\Service\{
    TestService
};

require_once __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/../src/config.php';

$app = new Firefly($config);
$receive_message = $app->getMessage();

// example
$entity = null;

if ($receive_message->checkMessageKind('Text') && $receive_message->hasText('twitter')) {
    $entity = new TestService($receive_message);
}

$app->sendMessage($entity->getResponseData());
