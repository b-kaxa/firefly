<?php
use Firefly\Application as Firefly;

require_once __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/../src/config.php';

$app = new Firefly($config);
$receive_message = $app->getMessage();

// example
$entity = null;

if ($receive_message->checkMessageKind('Text') && $receive_message->hasText('twitter')) {
    $entity = $app->generateImage($receive_message);
    $entity->setBothImageUrl('http://1.bp.blogspot.com/-nMTqgygyczs/VqtZItHn2_I/AAAAAAAA3ZY/5ZfrZPuZzbY/s800/bird_aoitori_bluebird.png');
    $app->sendMessage($entity->getResponseData());
    exit;
};

if ($receive_message->checkOperationType('FriendAdd')) {
    $entity = $app->generateText($receive_message);
    $entity->setTo($receive_message->getAddedOrBlockedUserMid());
    $entity->setText('友だち追加ありがとう');
    $app->sendMessage($entity->getResponseData());
    exit;
};

if ($receive_message->checkOperationType('Blocked')) {
    $entity = $app->generateText($receive_message);
    $entity->setText('block');
    $entity->setTo($receive_message->getAddedOrBlockedUserMid());
    $app->sendMessage($entity->getResponseData());
    exit;
};
exit(1);
