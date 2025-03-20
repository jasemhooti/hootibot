<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/database.php';

use Telegram\Bot\Api;

$telegram = new Api(BOT_TOKEN);

// دستور اصلی /start
$telegram->addCommand(\Telegram\Bot\Commands\HelpCommand::class);

// مدیریت رویدادها
$update = $telegram->getWebhookUpdate();

// منطق اصلی ربات
if ($update->getMessage()) {
    $message = $update->getMessage();
    $chat_id = $message->getChat()->getId();
    
    if ($message->getText() == '/start') {
        // نمایش منوی اصلی
        $keyboard = [
            ['خرید VPN', 'شارژ حساب'],
            ['بازی آنلاین', 'تیکت پشتیبانی']
        ];
        
        $reply_markup = $telegram->replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false
        ]);
        
        $telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'به ربات خوش آمدید!',
            'reply_markup' => $reply_markup
        ]);
    }
}

// بقیه منطق ربات...
