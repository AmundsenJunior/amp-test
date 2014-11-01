#!/usr/bin/env bash

# Variables
DBHOST=localhost
DBNAME=test_db
DBUSER=root
DBPASSWORD=root

echo -e "\n--- Updating/upgrading packages list ---\n"
apt-get update
apt-get -y upgrade

echo -e "\n--- Install LAMP and configure Server ---\n"
echo "mysql-server mysql-server/root_password password $DBPASSWORD" | debconf-set-selections
echo "mysql-server mysql-server/root_password_again password $DBPASSWORD" | debconf-set-selections
apt-get -y install lamp-server^

echo -e "\n--- Install phpMyAdmin ---\n"
echo "phpmyadmin phpmyadmin/dbconfig-install boolean true" |debconf-set-selections
echo "phpmyadmin phpmyadmin/app-password-confirm password $DBPASSWORD" | debconf-set-selections
echo "phpmyadmin phpmyadmin/mysql/admin-pass password $DBPASSWORD" | debconf-set-selections
echo "phpmyadmin phpmyadmin/mysql/app-pass password $DBPASSWORD" | debconf-set-selections
echo "phpmyadmin phpmyadmin/reconfigure-webserver multiselect none" | debconf-set-selections
apt-get -y install phpmyadmin

echo -e "\n--- Enable Apache modules and link /var/www/ to project ---\n"
a2enmod php5
php5enmod pdo
php5enmod pdo_mysql
service apache2 restart
apt-get install -y phpmyadmin
rm -rf /var/www
ln -fs /vagrant /var/www

