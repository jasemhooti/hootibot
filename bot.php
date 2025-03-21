<?php

require 'vendor/autoload.php';
$config = require 'config.php';

use Telegram\Bot\Api;

$telegram = new Api($config['bot_token']);
$updates = $telegram->getWebhookUpdates();

if ($updates->isType('message')) {
    $message = $updates->getMessage();
    $chatId = $message->getChat()->getId();

    switch ($message->getText()) {
        case '/start':
            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => 'Welcome to HootiBot! Please choose an option:',
                'reply_markup' => json_encode([
                    'keyboard' => [
                        [['text' => 'Buy VPN'], ['text' => 'Check Balance']],
                        [['text' => 'Support'], ['text' => 'Settings']],
                    ],
                    'resize_keyboard' => true,
                    'one_time_keyboard' => true,
                ]),
            ]);
            break;

        // More cases for handling different commands and messages
    }
}
?>
