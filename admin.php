<?php
require 'config.php';

// چک کردن دسترسی ادمین
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    die("Access Denied!");
}

// نمایش کاربران و تراکنش‌ها
echo "<h1>مدیریت کاربران</h1>";
?>
