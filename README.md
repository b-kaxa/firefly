firefly
=======

* simple client for LINE bot API
* require >= PHP 7.0.0

## Setup (on heroku)
* `git clone https://github.com/b-kaxa/firefly.git`
* `cd firefly`
* make index.php
* set ENV vars on heroku
    * app > Settings > Config Variables
        * your LINE_CHANNEL_ID
        * your LINE_CHANNEL_MID
        * your LINE_CHANNEL_SECRET
        * your PROXY_URL (add add-on 'fixie' to your app)
* set IP whitelist on LINE developers
* deploy to heroku

## Usage

* in index.php

```php
$app = new Firefly($config);
$receive_message = $app->getMessage();
$entity = null;

if ($receive_message->checkMessageKind('Text') && $receive_message->hasText('twitter')) {
    $entity = $app->generateImage($receive_message);
    $entity->setBothImageUrl('[some image url]');
    $app->sendMessage($entity->getResponseData());
    exit;
};
```

## This repo is working in progress
* please submit issue or your pull-request