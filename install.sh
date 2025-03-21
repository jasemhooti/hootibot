#!/bin/bash

# Update and install necessary packages
sudo apt-get update
sudo apt-get install -y php php-curl php-cli php-mbstring curl unzip

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Clone the project and install dependencies
git clone https://github.com/jasemhooti/hootibot.git
cd hootibot
composer install

echo "Installation completed. Please configure your bot token and admin ID in the config.php file."
