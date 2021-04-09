#!/bin/bash
echo -e
echo -e "LazyWP script intended for demonstration purposed only!"
echo -e
echo -e "Installs WordPress in the simplest manner possible."
echo -e
echo -e "Useful for developing and testing WP plugins and themes, or as"
echo -e "a starting point for your own WP images built with Packer, but"
echo -e "please do NOT attempt to run a production WP site with this as is."
echo -e
apt-get update
apt-get -y install wget git
git clone https://github.com/teddysun/lamp.git
cd lamp
chmod 755 *.sh
./lamp.sh --apache_option 1 --apache_modules mod_wsgi,mod_security --db_option 2 --db_root_pwd terriblepassword --php_option 5 --php_extensions apcu,ioncube,imagick,libsodium,opcache,swoole,xdebug --db_manage_modules phpmyadmin,adminer --kodexplorer_option 2
cd ..
set -eux
version='5.6.2'
curl -o wordpress.tar.gz -fL "https://wordpress.org/wordpress-$version.tar.gz"
tar -xzf wordpress.tar.gz -C /data/www/default
rm wordpress.tar.gz