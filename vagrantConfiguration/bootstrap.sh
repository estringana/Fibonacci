#!/bin/bash

#Variables
PROJECT='app'

# Creates the folder of the project
sudo mkdir "/var/www/${PROJECT}"

# update
sudo apt-get update

# Install Apache 
sudo apt-get install -y apache2

# Install PHP
sudo apt-get install -y php5

# Install Mysql and the php Mysql module
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password root"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password root"
sudo apt-get -y install mysql-server
sudo apt-get install php5-mysql
sudo apt-get install mysql-client-core-5.5

# Setting up the website on apache
VHOST=$(cat <<EOF
<VirtualHost *:80>
	ServerAdmin webmaster@localhost

	DocumentRoot /var/www/app
	<Directory />
		Options FollowSymLinks
		AllowOverride None
	</Directory>
	<Directory /var/www/app/>
		Options Indexes FollowSymLinks MultiViews
		AllowOverride None
		Order allow,deny
		allow from all
	</Directory>

	ScriptAlias /cgi-bin/ /usr/lib/cgi-bin/
	<Directory "/usr/lib/cgi-bin">
		AllowOverride None
		Options +ExecCGI -MultiViews +SymLinksIfOwnerMatch
		Order allow,deny
		Allow from all
	</Directory>

	ErrorLog /var/log/apache2/error.log

	# Possible values include: debug, info, notice, warn, error, crit,
	# alert, emerg.
	LogLevel warn

	CustomLog /var/log/apache2access.log combined

    Alias /doc/ "/usr/share/doc/"
    <Directory "/usr/share/doc/">
        Options Indexes MultiViews FollowSymLinks
        AllowOverride None
        Order deny,allow
        Deny from all
        Allow from 127.0.0.0/255.0.0.0 ::1/128
    </Directory>

</VirtualHost>
EOF
)
echo "${VHOST}" > /etc/apache2/sites-available/default

# enable mod_rewrite
sudo a2enmod rewrite

# restart apache
service apache2 restart

#–----------------------------------------------------------
# Redis
apt-get -y install make
 
mkdir /opt/redis

cd /opt/redis
# Use latest stable
wget http://download.redis.io/redis-stable.tar.gz
# Only update newer files
tar -xz --keep-newer-files -f redis-stable.tar.gz

cd redis-stable
make
make install
rm /etc/redis.conf
mkdir -p /etc/redis
mkdir /var/redis
chmod -R 777 /var/redis
useradd redis

cp -u /vagrant/vagrantConfiguration/redis.conf /etc/redis/6379.conf
cp -u /vagrant/vagrantConfiguration/redis.init.d /etc/init.d/redis_6379

update-rc.d redis_6379 defaults

chmod a+x /etc/init.d/redis_6379
/etc/init.d/redis_6379 start
# End Redis
#–----------------------------------------------------------