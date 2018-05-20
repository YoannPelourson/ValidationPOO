#!/bin/bash
DBPASSWD=password
DBNAME=blog
DBUSER=yopi





sudo apt-get update
sudo apt-get install -y vim curl get wget
sudo apt-get install -y mysql-server
#-------------------------------------------------------------------------------------


#---------------Create MySQL User-----------------------------------------------------
#sudo su 
#mysql --database=mysql -e "CREATE USER 'yopi'@'localhost' IDENTIFIED BY 'password';"
#mysql --database=mysql -e "CREATE USER 'yopi'@'%' IDENTIFIED BY 'password';"
#mysql --database=mysql -e "GRANT ALL ON *.* TO 'yopi'@'localhost';" 
#mysql --database=mysql -e "GRANT ALL ON *.* TO 'yopi'@'%';"
#exit
#------------------------------------------------------------------------------------- 
sudo apt-get install -y apache2
sudo apt-get install -y php7.0
sudo rm -r /var/www/html
ln -s /vagrant/web/ /var/www/html
#sudo apt-get install -y phpmyadmin

debconf-set-selections <<< "mysql-server mysql-server/root_password password $DBPASSWD"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $DBPASSWD"
debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password $DBPASSWD"
debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password $DBPASSWD"
debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password $DBPASSWD"
debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect none"
apt-get -y install mysql-server phpmyadmin >> /vagrant/vm_build.log 2>&1

mysql -uroot -p$DBPASSWD -e "CREATE DATABASE $DBNAME" >> /vagrant/vm_build.log 2>&1
mysql -uroot -p$DBPASSWD -e "grant all privileges on $DBNAME.* to '$DBUSER'@'localhost' identified by '$DBPASSWD'" > /vagrant/vm_build.log 2>&1



#-------------------------------------------------------------------------------------

sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php/7.0/apache2/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php/7.0/apache2/php.ini
service apache2 restart >> /vagrant/vm_build.log 2>&1