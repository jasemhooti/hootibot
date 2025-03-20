#!/bin/bash

# Update packages
sudo apt-get update

# Install PHP and required extensions
sudo apt-get install -y php php-curl php-mysql php-cli php-json php-mbstring php-zip unzip

# Install MySQL
sudo apt-get install -y mysql-server

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer

# Clone repository
git clone https://github.com/jasemhooti/hootibot.git
cd hootibot

# Create database
sudo mysql -e "CREATE DATABASE hootibot_db;"
sudo mysql -e "CREATE USER 'hootibot_user'@'localhost' IDENTIFIED BY 'StrongPassword123';"
sudo mysql -e "GRANT ALL PRIVILEGES ON hootibot_db.* TO 'hootibot_user'@'localhost';"
sudo mysql -e "FLUSH PRIVILEGES;"

# Import database schema
sudo mysql hootibot_db < database.sql

# Install PHP dependencies
composer require telegram-bot/api

# Set permissions
chmod 755 -R storage/
chmod 755 -R uploads/

echo "Installation completed! Please edit includes/config.php with your details"
