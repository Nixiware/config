#!/bin/bash

# install required components
apt-get update
apt-get install -y git unzip

# install composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"

# install dependencies
php composer.phar install