#!/bin/bash

echo "شروع نصب HootiBot..."

# دریافت اطلاعات از کاربر
read -p "توکن ربات را وارد کنید: " BOT_TOKEN
read -p "آیدی عددی ادمین را وارد کنید: " ADMIN_ID
read -p "دامنه X-UI را وارد کنید (مثال: https://panel.example.com): " PANEL_URL
read -p "توکن API پنل X-UI را وارد کنید: " PANEL_API_KEY

# نصب پیش‌نیازها
apt update && apt upgrade -y
apt install -y php php-cli php-curl unzip git

# دانلود و تنظیم ربات
git clone https://github.com/jasemhooti/hootibot.git /opt/hootibot
cd /opt/hootibot

# ایجاد فایل کانفیگ
cat > config.php <<EOL
<?php
define('BOT_TOKEN', '$BOT_TOKEN');
define('ADMIN_ID', '$ADMIN_ID');
define('PANEL_URL', '$PANEL_URL');
define('PANEL_API_KEY', '$PANEL_API_KEY');
?>
EOL

# اجرای ربات
php bot.php
echo "ربات با موفقیت نصب شد و اجرا شد!"
echo "@reboot php /opt/hootibot/bot.php" | crontab -
