#!/bin/bash

echo "Updating system and installing required packages..."
sudo apt update && sudo apt upgrade -y
sudo apt install -y php php-curl php-mbstring php-xml unzip git

echo "Cloning hootibot repository..."
git clone https://github.com/jasemhooti/hootibot.git /opt/hootibot

echo "Setting up bot..."
cd /opt/hootibot
cp config.example.php config.php

echo "Installation complete. Please edit config.php and set your bot token and admin ID."
