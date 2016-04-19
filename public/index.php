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

if ($receive_message->checkMessageKind('Text') && $receive_message->hasText('コンビニ')) {
    $entity = $app->generateImage($receive_message);
    $entity->setBothImageUrl('http://4.bp.blogspot.com/-XIuPfUGgqU4/Vtj9vC20r4I/AAAAAAAA4U0/p3Halb7w7fA/s800/convenience_store_car_jiko.png');
    $app->sendMessage($entity->getResponseData());
    exit;
};

if ($receive_message->checkMessageKind('Text') && $receive_message->hasText('みなさん')) {
    $entity = $app->generateText($receive_message);
    $entity->setText('楽しんでますか？');
    $app->sendMessage($entity->getResponseData());
    $entity = $app->generateText($receive_message);
    $entity->setText('（ここで歓声）');
    $app->sendMessage($entity->getResponseData());
    exit;
};

if ($receive_message->checkMessageKind('Text') && $receive_message->hasText('PHP')) {
    $entity = $app->generateText($receive_message);
    $entity->setText('BLT');
    $app->sendMessage($entity->getResponseData());

    $entity = $app->generateImage($receive_message);
    $entity->setBothImageUrl('http://2.bp.blogspot.com/-6iKr4j2u0CM/VXOTqi0XKvI/AAAAAAAAuCI/Vgnoc8qASSk/s800/food_slider_hamburger_sandwitch.png');
    $app->sendMessage($entity->getResponseData());
    exit;
};

if ($receive_message->checkMessageKind('Text') && $receive_message->hasText('LT')) {
    $entity = $app->generateImage($receive_message);
    $entity->setBothImageUrl('http://2.bp.blogspot.com/-ZCsTvsjxooM/U2Luwul3zDI/AAAAAAAAfwQ/No8KXBeFofI/s800/message_yoroshiku.png');
    $app->sendMessage($entity->getResponseData());
    $entity = $app->generateText($receive_message);
    $entity->setText('（ここで拍手）');
    $app->sendMessage($entity->getResponseData());
    exit;
};
exit(1);
