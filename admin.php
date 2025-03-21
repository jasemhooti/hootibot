<?php

require 'vendor/autoload.php';
$config = require 'config.php';

use Telegram\Bot\Api;

$telegram = new Api($config['bot_token']);
$updates = $telegram->getWebhookUpdates();

if ($updates->isType('message')) {
    $message = $updates->getMessage();
    $chatId = $message->getChat()->getId();

    if ($chatId == $config['admin_id']) {
        // Admin commands handling
    }
}
?>
