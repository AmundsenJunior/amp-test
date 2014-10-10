#!/usr/bin/env bash

# Variables
DBHOST=localhost
DBNAME=test_db
DBUSER=root
DBPASSWORD=root

echo -e "\n--- Updating/upgrading packages list ---\n"
apt-get update
apt-get -y upgrade

echo -e "\n--- Installing vim and git ---\n"
apt-get -y install vim git

echo -e "\n--- Install LAMP and configure Server ---\n"
echo "mysql-server mysql-server/root_password password $DBPASSWORD" | debconf-set-selections
echo "mysql-server mysql-server/root_password_again password $DBPASSWORD" | debconf-set-selections
apt-get -y install lamp-server^

#a2enmod php5
#php5enmod pdo
#php5enmod pdo_mysql
#service apache2 restart
#apt-get install -y phpmyadmin
#rm -rf /var/www
#ln -fs /vagrant /var/www
