<?php

require 'config.php';

$update = json_decode(file_get_contents("php://input"), true);
if (!$update) exit;

$bot_token = $config['bot_token'];
$admin_id = $config['admin_id'];

function sendMessage($chat_id, $text, $keyboard = null) {
    global $bot_token;
    $url = "https://api.telegram.org/bot$bot_token/sendMessage";
    $data = [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => 'Markdown'
    ];
    if ($keyboard) {
        $data['reply_markup'] = json_encode(['inline_keyboard' => $keyboard]);
    }
    file_get_contents($url . "?" . http_build_query($data));
}

// مدیریت پیام‌ها
if (isset($update['message'])) {
    $message = $update['message'];
    $chat_id = $message['chat']['id'];
    $text = $message['text'] ?? '';

    if ($text == "/start") {
        sendMessage($chat_id, "👋 خوش آمدید! لطفا گزینه مورد نظر را انتخاب کنید.", [
            [['text' => '📦 خرید اشتراک', 'callback_data' => 'buy']],
            [['text' => '💰 شارژ حساب', 'callback_data' => 'deposit']],
            [['text' => '🎮 بازی دو نفره', 'callback_data' => 'game']]
        ]);
    }
}

// مدیریت دکمه‌های شیشه‌ای
if (isset($update['callback_query'])) {
    $callback = $update['callback_query'];
    $chat_id = $callback['message']['chat']['id'];
    $data = $callback['data'];

    if ($data == "buy") {
        sendMessage($chat_id, "📦 لطفا حجم مورد نظر را انتخاب کنید:", [
            [['text' => '10 گیگ - 50 هزار تومان', 'callback_data' => 'buy_10']],
            [['text' => '20 گیگ - 90 هزار تومان', 'callback_data' => 'buy_20']]
        ]);
    } elseif ($data == "buy_10") {
        sendMessage($chat_id, "✅ لطفا مبلغ 50 هزار تومان را کارت به کارت کنید و رسید را ارسال کنید.");
    }
}

?>
