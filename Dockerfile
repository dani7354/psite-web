ARG debian_release=bullseye

FROM debian:${debian_release}

# Install required packages
RUN apt update && apt install -y \
    wget \
    gnupg2 \
    apache2 \
    && apt clean

# Install PHP-FPM and modules
ARG debian_release
ARG php_version=8.3

RUN wget -q https://packages.sury.org/php/apt.gpg -O- | apt-key add -
RUN echo "deb https://packages.sury.org/php/ ${debian_release} main" | tee /etc/apt/sources.list.d/php.list
RUN apt update && apt install -y \
    libapache2-mod-fcgid \
    php${php_version} \
    php${php_version}-cli \
    php${php_version}-cgi \
    php${php_version}-common \
    php${php_version}-fpm \
    php${php_version}-gd \
    php${php_version}-mbstring \
    php${php_version}-mysql \
    && apt clean

# Add website files
ARG wwwroot=/var/www
ARG composer_installer_hash=dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6

RUN rm -R ${wwwroot}/html/
COPY ./psite-web/app $wwwroot

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
COPY ./psite-web/apache/conf-available/remoteip.conf /etc/apache2/conf-available/remoteip.conf

COPY ./psite-web/apache/mods-available/fcgid.conf /etc/apache2/mods-available/fcgi.conf

# Copy PHP and PHP-FPM configs
COPY ./psite-web/php/php.ini-production /etc/php/${php_version}/fpm/php.ini
COPY ./psite-web/php/fpm/php-fpm.conf /etc/php/${php_version}/fpm/php-fpm.conf
COPY ./psite-web/php/fpm/pool.d/www.conf /etc/php/${php_version}/fpm/pool.d/www.conf

# Mount the correct certificate location as volume in .yaml file
RUN mkdir /etc/apache2/ssl
RUN mkdir /var/log/php-fpm

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
    mpm_event \
    remoteip

RUN a2enconf \
    security \
    ssl-parameters \
    php${php_version}-fpm \
    remoteip

RUN a2ensite default-ssl

# chown wwwroot + apache restart
RUN chown -R www-data:www-data "$wwwroot"

# Copy start script
COPY ./psite-web/docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 80
EXPOSE 443

CMD [ "/usr/local/bin/start.sh" ]
