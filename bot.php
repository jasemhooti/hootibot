<?php
require 'config.php';

$API_URL = "https://api.telegram.org/bot" . BOT_TOKEN . "/";
$update = json_decode(file_get_contents("php://input"), true);

if (isset($update["message"])) {
    $chat_id = $update["message"]["chat"]["id"];
    $message_text = $update["message"]["text"];
    $user_id = $update["message"]["from"]["id"];

    if ($message_text == "/start") {
        sendMessage($chat_id, "👋 خوش آمدید! لطفاً یکی از پلن‌های زیر را انتخاب کنید:\n\n💳 10 گیگ - 10,000 تومان\n💳 20 گیگ - 20,000 تومان\n\nبرای خرید، مبلغ را کارت به کارت کنید و رسید را برای ادمین ارسال کنید.");
    } elseif (strpos($message_text, "پرداخت") !== false) {
        sendMessage(ADMIN_ID, "📢 یک پرداخت جدید دریافت شد:\n\nفرستنده: $user_id\n$message_text");
        sendMessage($chat_id, "✅ اطلاعات پرداخت ارسال شد. منتظر تأیید ادمین باشید.");
    }
}

// ارسال پیام به کاربر
function sendMessage($chat_id, $text) {
    global $API_URL;
    file_get_contents($API_URL . "sendMessage?chat_id=$chat_id&text=" . urlencode($text));
}

// ارسال کانفیگ به کاربر
function sendConfig($chat_id, $size_gb) {
    global $API_URL, $user_id;
    
    $config_link = generateConfig($size_gb);
    sendMessage($chat_id, "✅ خرید شما تأیید شد!\n\n🔗 لینک کانفیگ شما:\n$config_link");
}

// ایجاد لینک کانفیگ از X-UI
function generateConfig($size_gb) {
    global $PANEL_URL, $PANEL_API_KEY;

    $data = [
        "remark" => "UserVPN",
        "port" => rand(10000, 60000),
        "limitGB" => $size_gb
    ];

    $ch = curl_init("$PANEL_URL/api/addClient");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $PANEL_API_KEY", "Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true)['link'] ?? "خطا در ایجاد کانفیگ!";
}
?>
