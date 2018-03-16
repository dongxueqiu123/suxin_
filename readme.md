## Deployment:

1) server software requirements:
- Node.js
- PHP >= 7.0.0
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- nginx (preferable) or apache installed
- composer
- git
- bower
- MySQL

2) git clone from project repo

3)
cd suxinframework
within root project folder:
npm install
composer install
4)
within "public" folder: (cd suxinframework/public)
bower install --allow-root
5) 
sudo chmod 755 ~/suxinframework/access.log
sudo chmod 755 ~/suxinframework/error.log
sudo chmod -R 755 ~/suxinframework/storage
sudo chmod -R 755 ~/suxinframework/bootstrap/cache
6) setup database
* setup encyption key:
from the root project folder run this command:
php artisan key:generate
- rename .env.example file to .env
- create database
- change DB credentials in .env file: (sample)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=suxin_laravel
DB_USERNAME=root
DB_PASSWORD=root
7) Migration:
php artisan migrate --seed
7) configure nginx / apache

## nginx virtual host configuration sample (without ssl): (/etc/nginx/sites-available)

server {
        listen 80 default_server;
        listen [::]:80 default_server;
        root /var/www/suxinframework/public;
        index index.php index.html index.htm index.nginx-debian.html;
        server_name www.suxinframework.io;
        location / {
                try_files $uri $uri/ /index.php?$args;
        }
        location ~ \.php$ {
                include snippets/fastcgi-php.conf;
                fastcgi_pass unix:/run/php/php7.0-fpm.sock;
        }
        location ~ /\.ht {
                deny all;
        }
}

## nginx virtual host configuration sample (for ssl): (/etc/nginx/sites-available)

server {
        listen 443 ssl;
        server_name suxinframework.io;
        return 301 https://www.suxinframework.io$request_uri;
        ssl on;
        ssl_certificate /var/www/suxinframework/certs/__suxinframework_io.crt;
        ssl_certificate_key /var/www/suxinframework_io.key;
}

server {
        listen 80 default_server;
        listen [::]:80 default_server;
        server_name suxinframework.io;
        return 301 https://www.suxinframework.io$request_uri;
}

server {
        listen 443 ssl;
        root /var/www/suxinframework/public;
        index index.php index.html index.htm index.nginx-debian.html;
        server_name www.suxinframework.io;
        location / {
                try_files $uri $uri/ /index.php?$args;
        }

        location ~ \.php$ {
                include snippets/fastcgi-php.conf;
                fastcgi_pass unix:/run/php/php7.0-fpm.sock;
        }

        location ~ /\.ht {
                deny all;
        }
}

## apache virtual host configuration sample:

<VirtualHost *:80>
        ServerName "suxinframework.io"
        DocumentRoot "/web_projects/suxinframework/public"
        <Directory "/web_projects/suxinframework/public">
           Options Indexes MultiViews FollowSymlinks
           AllowOverride All
           Order allow,deny
           Allow from all
        </Directory>
        ErrorLog /web_projects/suxinframework/error.log
        CustomLog /web_projects/suxinframework/access.log combined
</VirtualHost>

## some link for another deployment guide

https://www.digitalocean.com/community/tutorials/how-to-deploy-a-laravel-application-with-nginx-on-ubuntu-16-04