ARG debian_release=bullseye

FROM debian:${debian_release}

# Install required packages
RUN apt update && apt install -y \
    wget \ 
    gnupg2 \
    apache2

# Install PHP-FPM and modules
ARG debian_release
RUN wget -q https://packages.sury.org/php/apt.gpg -O- | apt-key add -
RUN echo "deb https://packages.sury.org/php/ ${debian_release} main" | tee /etc/apt/sources.list.d/php.list
RUN apt update && apt install -y \ 
    libapache2-mod-fcgid \
    php8.1 \
    php8.1-cli \
    php8.1-cgi \
    php8.1-common \
    php8.1-fpm \
    php8.1-gd \
    php8.1-mbstring \
    php8.1-mysql

# Add website files
ARG wwwroot=/var/www
ARG composer_installer_hash=55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae

RUN rm -R ${wwwroot}/html/
COPY ./psite-web/app $wwwroot
RUN mkdir ${wwwroot}/html/goaccess
RUN mkdir ${wwwroot}/htpasswd

# Download and  install composer
WORKDIR /tmp
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '$composer_installer_hash') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); exit(1); } echo PHP_EOL;"
RUN php composer-setup.php
RUN mv composer.phar /usr/local/sbin/composer
RUN rm composer-setup.php

WORKDIR $wwwroot
RUN composer install

# Copy apache configs
COPY ./psite-web/apache/apache2.conf /etc/apache2/apache2.conf
COPY ./psite-web/apache/sites-available/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY ./psite-web/apache/sites-available/default-ssl.conf /etc/apache2/sites-available/default-ssl.conf
COPY ./psite-web/apache/conf-available/security.conf /etc/apache2/conf-available/security.conf
COPY ./psite-web/apache/conf-available/ssl-parameters.conf /etc/apache2/conf-available/ssl-parameters.conf
COPY ./psite-web/apache/mods-available/fcgid.conf /etc/apache2/mods-available/fcgi.conf

# Copy PHP and PHP-FPM configs
COPY ./psite-web/php/php.ini-production /etc/php/8.1/fpm/php.ini
COPY ./psite-web/php/fpm/php-fpm.conf /etc/php/8.1/fpm/php-fpm.conf
COPY ./psite-web/php/fpm/pool.d/www.conf /etc/php/8.1/fpm/pool.d/www.conf

# Create a new private key and self-signed X.509 certificate.
# FOR LOCAL TESTING ONLY! Mount the correct certificate location as volume in .yaml file  
ARG ssl_dir=/etc/apache2/ssl
RUN mkdir $ssl_dir
RUN openssl req -x509 -nodes \
    -days 365 \
    -newkey rsa:4096 \
    -keyout ${ssl_dir}/server.key \
    -subj "/C=DK/ST=Denmark/O=Test/CN=www.stuhrs.dk" \
    -out ${ssl_dir}/server.crt

RUN chmod 400 ${ssl_dir}/server.key
RUN chmod 444 ${ssl_dir}/server.crt

# Enable/disable apache2 mods, configs and sites
RUN a2dismod mpm_prefork

RUN a2enmod \ 
    rewrite \
    ssl \
    headers \
    socache_shmcb \
    setenvif \
    alias \
    proxy \
    proxy_fcgi \
    http2 \
    mpm_event

RUN a2enconf \
    security \
    ssl-parameters \
    php8.1-fpm

RUN a2ensite default-ssl

# chown wwwroot + apache restart
RUN chown -R www-data:www-data $wwwroot
RUN service apache2 restart

# Copy start script
COPY ./psite-web/docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 80
EXPOSE 443

CMD [ "/usr/local/bin/start.sh" ]

